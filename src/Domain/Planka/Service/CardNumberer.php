<?php

declare(strict_types=1);

namespace App\Domain\Planka\Service;

use App\Domain\Planka\DTO\Board;
use App\Domain\Planka\DTO\Card;
use App\Domain\Planka\DTO\NumberingResult;
use App\Domain\Planka\Model\BranchName;
use App\Domain\Planka\Model\CardTitle;
use App\Domain\Planka\Repository\CardCounterRepository;
use App\Infrastructure\Planka\PlankaClient;
use Symfony\Component\DependencyInjection\Attribute\Autowire;
use Symfony\Contracts\HttpClient\Exception\ExceptionInterface;

/**
 * Numérote les cartes Planka (« #42 · Titre ») et remplit leur champ « Branche » (« feat/42-titre »).
 */
readonly class CardNumberer
{
    /**
     * @param array<string, string> $branchPrefixes préfixe de branche par nom d'étiquette ; la première étiquette
     *                                              de cette liste portée par la carte l'emporte
     */
    public function __construct(
        private PlankaClient $client,
        private CardCounterRepository $counter,
        #[Autowire(param: 'planka.branch_prefixes')]
        private array $branchPrefixes,
        #[Autowire(param: 'planka.default_branch_prefix')]
        private string $defaultBranchPrefix,
    ) {
    }

    /**
     * Carte tout juste créée : elle reçoit toujours un nouveau numéro, même si son titre en porte déjà un
     * (une carte dupliquée hérite du titre « #42 · … » de l'originale).
     *
     * @throws ExceptionInterface
     */
    public function numberNewCard(string $cardId): NumberingResult
    {
        $card = $this->client->findCard($cardId);
        $board = null !== $card ? $this->client->findBoard($card->boardId) : null;
        if (null === $card || null === $board) {
            return NumberingResult::ignored($cardId, 'card not accessible to the hooks account');
        }

        return $this->assignNumber($card, $board);
    }

    /**
     * Étiquette ajoutée ou retirée : recalcule le préfixe du champ « Branche » en gardant numéro et slug.
     *
     * @throws ExceptionInterface
     */
    public function refreshBranchPrefix(string $cardId): NumberingResult
    {
        $card = $this->client->findCard($cardId);
        $board = null !== $card ? $this->client->findBoard($card->boardId) : null;
        if (null === $card || null === $board) {
            return NumberingResult::ignored($cardId, 'card not accessible to the hooks account');
        }
        if (null === $board->branchField) {
            return NumberingResult::ignored($cardId, 'no branch field on this board');
        }

        $prefix = $this->prefixFor($board, $card);
        $current = $card->customFieldValue($board->branchField);
        $branch = BranchName::parse($current ?? '')?->withPrefix($prefix);

        if (null === $branch) {
            $number = CardTitle::fromName($card->name)->number;
            if (null === $number) {
                return NumberingResult::ignored($cardId, 'card is not numbered');
            }
            $branch = BranchName::fromTitle($prefix, $number, CardTitle::fromName($card->name)->text);
        }

        if ((string) $branch === $current) {
            return NumberingResult::unchanged($cardId, $current);
        }

        $this->client->setCustomFieldValue($cardId, $board->branchField, (string) $branch);

        return NumberingResult::updated($cardId, (string) $branch);
    }

    /**
     * Numérotation rétroactive d'un tableau, dans l'ordre de création des cartes. Couvre les listes actives
     * et fermées ; pas la liste système d'archive, dont la pagination est cassée en Planka 2.1.1
     * (plankanban/planka#1761 : HTTP 500 dès qu'un curseur « before » est passé).
     * Une carte déjà numérotée garde son numéro ; seul son champ « Branche » est complété.
     *
     * @throws ExceptionInterface
     *
     * @return iterable<NumberingResult>
     */
    public function numberExistingCards(string $boardId, bool $dryRun = false): iterable
    {
        $board = $this->client->findBoard($boardId);
        if (null === $board) {
            yield NumberingResult::ignored(null, \sprintf('board %s not accessible to the hooks account', $boardId));

            return;
        }

        $cards = $board->cards;
        usort($cards, static fn (Card $a, Card $b): int => [$a->createdAt, $a->id] <=> [$b->createdAt, $b->id]);

        $simulated = $this->counter->current($board->projectId, $board->highestNumber());

        foreach ($cards as $summary) {
            $card = $this->client->findCard($summary->id) ?? $summary;
            $title = CardTitle::fromName($card->name);

            if (null === $title->number) {
                if ($dryRun) {
                    yield $this->describe($card, $board, ++$simulated);
                } else {
                    yield $this->assignNumber($card, $board);
                }

                continue;
            }

            $branch = BranchName::fromTitle($this->prefixFor($board, $card), $title->number, $title->text);
            if (null === $board->branchField || '' !== ($card->customFieldValue($board->branchField) ?? '')) {
                yield NumberingResult::unchanged($card->id, null !== $board->branchField ? $card->customFieldValue($board->branchField) : null);

                continue;
            }

            if (!$dryRun) {
                $this->client->setCustomFieldValue($card->id, $board->branchField, (string) $branch);
            }

            yield NumberingResult::updated($card->id, (string) $branch);
        }
    }

    /**
     * @throws ExceptionInterface
     */
    private function assignNumber(Card $card, Board $board): NumberingResult
    {
        $number = $this->counter->next($board->projectId, $board->highestNumber());
        $result = $this->describe($card, $board, $number);

        $this->client->renameCard($card->id, (string) $result->title);
        if (null !== $board->branchField && null !== $result->branch) {
            $this->client->setCustomFieldValue($card->id, $board->branchField, $result->branch);
        }

        return $result;
    }

    private function describe(Card $card, Board $board, int $number): NumberingResult
    {
        $title = CardTitle::fromName($card->name)->withNumber($number);
        $branch = BranchName::fromTitle($this->prefixFor($board, $card), $number, $title->text);

        return null === $board->branchField
            ? NumberingResult::numbered($card->id, (string) $title, null, 'no branch field on this board')
            : NumberingResult::numbered($card->id, (string) $title, (string) $branch);
    }

    private function prefixFor(Board $board, Card $card): string
    {
        $labelNames = array_map(mb_strtolower(...), $board->labelNamesOf($card->labelIds));

        foreach ($this->branchPrefixes as $labelName => $prefix) {
            if (\in_array(mb_strtolower($labelName), $labelNames, true)) {
                return $prefix;
            }
        }

        return $this->defaultBranchPrefix;
    }
}

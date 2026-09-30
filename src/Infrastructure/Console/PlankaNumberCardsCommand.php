<?php

declare(strict_types=1);

namespace App\Infrastructure\Console;

use App\Domain\Planka\DTO\NumberingResult;
use App\Domain\Planka\Service\CardNumberer;
use Symfony\Component\Console\Attribute\Argument;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Attribute\Option;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Contracts\HttpClient\Exception\ExceptionInterface;

#[AsCommand(
    name: 'app:planka:number-cards',
    description: 'Numérote rétroactivement les cartes d\'un tableau Planka et remplit leur champ « Branche »',
)]
readonly class PlankaNumberCardsCommand
{
    public function __construct(
        private CardNumberer $numberer,
    ) {
    }

    /**
     * @throws ExceptionInterface
     */
    public function __invoke(
        SymfonyStyle $io,
        #[Argument(description: 'Id du tableau Planka')]
        string $boardId,
        #[Option(description: 'Affiche ce qui serait fait, sans rien modifier')]
        bool $dryRun = false,
    ): int {
        if ($dryRun) {
            $io->note('Dry run : aucune carte ne sera modifiée, les numéros affichés sont une projection.');
        }

        $counts = [];
        $rows = [];
        foreach ($this->numberer->numberExistingCards($boardId, $dryRun) as $result) {
            $counts[$result->status] = ($counts[$result->status] ?? 0) + 1;
            if (NumberingResult::UNCHANGED !== $result->status) {
                $rows[] = [$result->status, $result->cardId ?? '-', $result->title ?? '', $result->branch ?? '', $result->reason ?? ''];
            }
        }

        $io->table(['Statut', 'Carte', 'Titre', 'Branche', 'Remarque'], $rows);
        $io->definitionList(...array_map(static fn (string $status, int $count): array => [$status => (string) $count], array_keys($counts), $counts));

        return isset($counts[NumberingResult::IGNORED]) ? Command::FAILURE : Command::SUCCESS;
    }
}

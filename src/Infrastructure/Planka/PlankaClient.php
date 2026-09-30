<?php

declare(strict_types=1);

namespace App\Infrastructure\Planka;

use App\Domain\Planka\DTO\Board;
use App\Domain\Planka\DTO\BranchField;
use App\Domain\Planka\DTO\Card;
use Symfony\Component\DependencyInjection\Attribute\Autowire;
use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ExceptionInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

/**
 * Adaptateur de l'API REST Planka v2 (authentification par en-tête X-Api-Key, posé par le client scopé).
 *
 * Planka répond 404 — et parfois 403 — quand le compte n'a pas accès à une ressource : le compte des hooks
 * n'agit donc que sur les tableaux dont il est membre, c'est l'adhésion au tableau qui active la numérotation.
 */
readonly class PlankaClient
{
    public function __construct(
        private HttpClientInterface $plankaClient,
        #[Autowire(param: 'planka.branch_field')]
        private string $branchFieldName,
    ) {
    }

    /**
     * @throws ExceptionInterface
     */
    public function findCard(string $cardId): ?Card
    {
        $data = $this->get('/api/cards/' . $cardId);
        if (null === $data) {
            return null;
        }

        $item = self::map($data, 'item');
        $included = self::map($data, 'included');

        return new Card(
            self::string($item, 'id'),
            self::string($item, 'name'),
            self::string($item, 'boardId'),
            self::string($item, 'createdAt'),
            array_map(static fn (array $cardLabel): string => self::string($cardLabel, 'labelId'), self::list($included, 'cardLabels')),
            self::customFieldValues(self::list($included, 'customFieldValues')),
        );
    }

    /**
     * @throws ExceptionInterface
     */
    public function findBoard(string $boardId): ?Board
    {
        $data = $this->get('/api/boards/' . $boardId);
        if (null === $data) {
            return null;
        }

        $item = self::map($data, 'item');
        $included = self::map($data, 'included');
        $projectId = self::string($item, 'projectId');

        $labelNames = [];
        foreach (self::list($included, 'labels') as $label) {
            $labelNames[self::string($label, 'id')] = self::nullableString($label, 'name') ?? '';
        }

        $labelIdsByCard = [];
        foreach (self::list($included, 'cardLabels') as $cardLabel) {
            $labelIdsByCard[self::string($cardLabel, 'cardId')][] = self::string($cardLabel, 'labelId');
        }

        $cards = array_map(static fn (array $card): Card => new Card(
            self::string($card, 'id'),
            self::string($card, 'name'),
            $boardId,
            self::string($card, 'createdAt'),
            $labelIdsByCard[self::string($card, 'id')] ?? [],
        ), self::list($included, 'cards'));

        return new Board(
            $boardId,
            $projectId,
            $labelNames,
            $this->findBranchField($projectId, $boardId, self::list($included, 'customFieldGroups')),
            $cards,
        );
    }

    /**
     * @throws ExceptionInterface
     */
    public function renameCard(string $cardId, string $name): void
    {
        $this->plankaClient->request('PATCH', '/api/cards/' . $cardId, ['json' => ['name' => $name]])->toArray();
    }

    /**
     * @throws ExceptionInterface
     */
    public function setCustomFieldValue(string $cardId, BranchField $field, string $content): void
    {
        $this->plankaClient->request('PATCH', \sprintf(
            '/api/cards/%s/custom-field-values/customFieldGroupId:%s:customFieldId:%s',
            $cardId,
            $field->customFieldGroupId,
            $field->customFieldId,
        ), ['json' => ['content' => $content]])->toArray();
    }

    /**
     * Le champ « Branche » est défini dans un groupe de base du projet ; un tableau l'expose via un groupe
     * de tableau basé sur ce groupe de base. Sans ce groupe sur le tableau, il n'y a pas de champ à remplir.
     *
     * @param list<array<mixed>> $boardCustomFieldGroups
     *
     * @throws ExceptionInterface
     */
    private function findBranchField(string $projectId, string $boardId, array $boardCustomFieldGroups): ?BranchField
    {
        $project = $this->get('/api/projects/' . $projectId);
        if (null === $project) {
            return null;
        }

        foreach (self::list(self::map($project, 'included'), 'customFields') as $field) {
            $baseGroupId = self::nullableString($field, 'baseCustomFieldGroupId');
            $name = self::nullableString($field, 'name') ?? '';
            if (null === $baseGroupId || 0 !== strcasecmp(trim($name), $this->branchFieldName)) {
                continue;
            }

            foreach ($boardCustomFieldGroups as $group) {
                if ($boardId === self::nullableString($group, 'boardId') && $baseGroupId === self::nullableString($group, 'baseCustomFieldGroupId')) {
                    return new BranchField(self::string($group, 'id'), self::string($field, 'id'));
                }
            }
        }

        return null;
    }

    /**
     * @param array<string, string> $query
     *
     * @throws ExceptionInterface
     *
     * @return array<mixed>|null null quand la ressource est introuvable ou inaccessible au compte
     */
    private function get(string $path, array $query = []): ?array
    {
        try {
            return $this->plankaClient->request('GET', $path, ['query' => $query])->toArray();
        } catch (ClientExceptionInterface $exception) {
            if (\in_array($exception->getResponse()->getStatusCode(), [403, 404], true)) {
                return null;
            }

            throw $exception;
        }
    }

    /**
     * @param list<array<mixed>> $values
     *
     * @return array<string, string>
     */
    private static function customFieldValues(array $values): array
    {
        $contents = [];
        foreach ($values as $value) {
            $field = new BranchField(self::string($value, 'customFieldGroupId'), self::string($value, 'customFieldId'));
            $contents[$field->key()] = self::nullableString($value, 'content') ?? '';
        }

        return $contents;
    }

    /**
     * @param array<mixed> $data
     *
     * @return array<mixed>
     */
    private static function map(array $data, string $key): array
    {
        $value = $data[$key] ?? [];
        if (!\is_array($value)) {
            throw new \UnexpectedValueException(\sprintf('Planka response field "%s" is not an object.', $key));
        }

        return $value;
    }

    /**
     * @param array<mixed> $data
     *
     * @return list<array<mixed>>
     */
    private static function list(array $data, string $key): array
    {
        $rows = [];
        foreach (self::map($data, $key) as $row) {
            if (!\is_array($row)) {
                throw new \UnexpectedValueException(\sprintf('Planka response field "%s" is not a list of objects.', $key));
            }
            $rows[] = $row;
        }

        return $rows;
    }

    /**
     * @param array<mixed> $data
     */
    private static function string(array $data, string $key): string
    {
        return self::nullableString($data, $key)
            ?? throw new \UnexpectedValueException(\sprintf('Planka response field "%s" is missing.', $key));
    }

    /**
     * @param array<mixed> $data
     */
    private static function nullableString(array $data, string $key): ?string
    {
        $value = $data[$key] ?? null;
        if (null !== $value && !\is_string($value)) {
            throw new \UnexpectedValueException(\sprintf('Planka response field "%s" is not a string.', $key));
        }

        return $value;
    }
}

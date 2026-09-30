<?php

declare(strict_types=1);

namespace App\Domain\Planka\DTO;

/**
 * Ce qu'il faut savoir d'une carte Planka pour la numéroter.
 */
final readonly class Card
{
    /**
     * @param list<string>          $labelIds
     * @param array<string, string> $customFieldValues contenu indexé par « <customFieldGroupId>:<customFieldId> »
     */
    public function __construct(
        public string $id,
        public string $name,
        public string $boardId,
        public string $createdAt,
        public array $labelIds = [],
        public array $customFieldValues = [],
    ) {
    }

    public function customFieldValue(BranchField $field): ?string
    {
        return $this->customFieldValues[$field->key()] ?? null;
    }
}

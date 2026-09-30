<?php

declare(strict_types=1);

namespace App\Domain\Planka\DTO;

/**
 * Emplacement du champ personnalisé « Branche » sur un tableau : le groupe du tableau
 * (basé sur le groupe de base du projet) et le champ défini dans ce groupe de base.
 */
final readonly class BranchField
{
    public function __construct(
        public string $customFieldGroupId,
        public string $customFieldId,
    ) {
    }

    public function key(): string
    {
        return $this->customFieldGroupId . ':' . $this->customFieldId;
    }
}

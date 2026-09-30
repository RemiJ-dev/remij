<?php

declare(strict_types=1);

namespace App\Domain\Planka\DTO;

use App\Domain\Planka\Model\CardTitle;

/**
 * Contexte d'un tableau Planka : projet (portée du compteur), étiquettes, champ « Branche », cartes.
 */
final readonly class Board
{
    /**
     * @param array<string, string> $labelNames nom des étiquettes, indexé par id
     * @param list<Card>            $cards      cartes des listes actives et fermées ; l'API du tableau n'inclut pas
     *                                          les listes système archive et corbeille
     */
    public function __construct(
        public string $id,
        public string $projectId,
        public array $labelNames,
        public ?BranchField $branchField,
        public array $cards,
    ) {
    }

    /**
     * @param list<string> $labelIds
     *
     * @return list<string>
     */
    public function labelNamesOf(array $labelIds): array
    {
        return array_values(array_filter(array_map(
            fn (string $labelId): ?string => $this->labelNames[$labelId] ?? null,
            $labelIds,
        ), static fn (?string $name): bool => null !== $name));
    }

    /**
     * Plus grand numéro déjà porté par un titre de carte du tableau (0 si aucun).
     */
    public function highestNumber(): int
    {
        $highest = 0;
        foreach ($this->cards as $card) {
            $highest = max($highest, CardTitle::fromName($card->name)->number ?? 0);
        }

        return $highest;
    }
}

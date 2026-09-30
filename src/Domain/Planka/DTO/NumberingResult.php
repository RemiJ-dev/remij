<?php

declare(strict_types=1);

namespace App\Domain\Planka\DTO;

/**
 * Résultat du traitement d'une carte, renvoyé tel quel dans la réponse du webhook.
 */
final readonly class NumberingResult
{
    public const string NUMBERED = 'numbered';
    public const string UPDATED = 'updated';
    public const string UNCHANGED = 'unchanged';
    public const string IGNORED = 'ignored';

    private function __construct(
        public string $status,
        public ?string $cardId,
        public ?string $title = null,
        public ?string $branch = null,
        public ?string $reason = null,
    ) {
    }

    public static function numbered(string $cardId, string $title, ?string $branch, ?string $reason = null): self
    {
        return new self(self::NUMBERED, $cardId, $title, $branch, $reason);
    }

    public static function updated(string $cardId, string $branch): self
    {
        return new self(self::UPDATED, $cardId, branch: $branch);
    }

    public static function unchanged(string $cardId, ?string $branch): self
    {
        return new self(self::UNCHANGED, $cardId, branch: $branch);
    }

    public static function ignored(?string $cardId, string $reason): self
    {
        return new self(self::IGNORED, $cardId, reason: $reason);
    }

    /**
     * @return array<string, string>
     */
    public function toArray(): array
    {
        return array_filter([
            'status' => $this->status,
            'cardId' => $this->cardId,
            'title' => $this->title,
            'branch' => $this->branch,
            'reason' => $this->reason,
        ], static fn (?string $value): bool => null !== $value);
    }
}

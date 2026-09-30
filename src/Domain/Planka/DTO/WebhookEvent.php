<?php

declare(strict_types=1);

namespace App\Domain\Planka\DTO;

/**
 * Événement de webhook Planka réduit à ce qui sert : son nom et la carte concernée.
 */
final readonly class WebhookEvent
{
    public const string CARD_CREATE = 'cardCreate';
    public const string CARD_LABEL_CREATE = 'cardLabelCreate';
    public const string CARD_LABEL_DELETE = 'cardLabelDelete';

    public function __construct(
        public string $name,
        public ?string $cardId,
    ) {
    }
}

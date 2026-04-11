<?php

declare(strict_types=1);

namespace App\Message;

use App\Trello\Connection;

final readonly class TrelloEvent
{
    /** @param array<string, mixed> $payload */
    public function __construct(
        public array $payload,
        public Connection $connection,
    ) {
    }
}

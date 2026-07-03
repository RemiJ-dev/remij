<?php

declare(strict_types=1);

namespace App\Domain\Publication\Model;

enum PublicationType: string
{
    case Article = 'article';
    case Tutorial = 'tutorial';

    public function getShowRoute(): string
    {
        return match ($this) {
            self::Article => 'article_show',
            self::Tutorial => 'tutorial_show',
        };
    }
}

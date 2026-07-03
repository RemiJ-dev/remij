<?php

declare(strict_types=1);

namespace App\Domain\Publication\Model;

/**
 * Common publishing behavior for contents carrying a `publishedAt` date
 * (a date in the future means the content is a draft) and an optional
 * `lastModified` date.
 */
trait PublishableTrait
{
    public function isPublished(): bool
    {
        return new \DateTimeImmutable() >= $this->publishedAt;
    }

    public function getLastModifiedOrCreated(): \DateTimeInterface
    {
        return $this->lastModified ?? $this->publishedAt;
    }
}

<?php

declare(strict_types=1);

namespace App\Domain\Publication\Model;

/**
 * Contract shared by the contents listable on the transversal pages
 * (tag, author) and aggregated in the Atom feed: articles and tutorials.
 * Chapters are not publications: their tags and authors belong to their
 * tutorial, and only their tutorial is listed on transversal pages.
 */
interface PublicationInterface
{
    public string $slug { get; }

    public string $title { get; }

    public ?string $description { get; }

    public ?string $image { get; }

    public \DateTimeInterface $publishedAt { get; }

    /** @var array<int, string> */
    public array $authors { get; }

    /** @var array<int, string> */
    public array $tags { get; }

    public function isPublished(): bool;

    public function getLastModifiedOrCreated(): \DateTimeInterface;

    public function getType(): PublicationType;
}

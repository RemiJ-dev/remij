<?php

declare(strict_types=1);

namespace App\Domain\Publication\DTO;

use App\Domain\Publication\Model\PublicationInterface;
use App\Domain\Tutorial\Model\Chapter;
use App\Domain\Tutorial\Model\Tutorial;

/**
 * A single, uniform entry of the Atom feed, whatever the content type.
 */
readonly class FeedEntry
{
    /**
     * @param array<string, string> $routeParams
     * @param array<int, string>    $authors     Author display names
     * @param array<int, string>    $tags
     */
    public function __construct(
        public string $title,
        public ?string $description,
        public string $routeName,
        public array $routeParams,
        public \DateTimeInterface $publishedAt,
        public \DateTimeInterface $updated,
        public array $authors,
        public array $tags,
    ) {
    }

    /**
     * @param array<int, string> $authorNames
     */
    public static function fromPublication(PublicationInterface $publication, array $authorNames): self
    {
        return new self(
            title: $publication->title,
            description: $publication->description,
            routeName: $publication->getType()->getShowRoute(),
            routeParams: ['slug' => $publication->slug],
            publishedAt: $publication->publishedAt,
            updated: $publication->getLastModifiedOrCreated(),
            authors: $authorNames,
            tags: $publication->tags,
        );
    }

    /**
     * A chapter entry inherits the authors and tags of its tutorial, and
     * its title is contextualized with the tutorial one.
     *
     * @param array<int, string> $authorNames
     */
    public static function fromChapter(Chapter $chapter, Tutorial $tutorial, array $authorNames): self
    {
        return new self(
            title: $tutorial->title . ' : ' . $chapter->title,
            description: $chapter->description,
            routeName: 'tutorial_chapter',
            routeParams: ['slug' => $chapter->slug],
            publishedAt: $chapter->publishedAt,
            updated: $chapter->getLastModifiedOrCreated(),
            authors: $authorNames,
            tags: $tutorial->tags,
        );
    }
}

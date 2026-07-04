<?php

declare(strict_types=1);

namespace App\Domain\Tutorial\Repository;

use App\Domain\Publication\Model\Author;
use App\Domain\Tutorial\Model\Chapter;
use App\Domain\Tutorial\Model\Tutorial;
use Stenope\Bundle\ContentManagerInterface;

class TutorialRepository
{
    public const string CLASS_NAME = Tutorial::class;
    public const string CHAPTER_CLASS_NAME = Chapter::class;

    public function __construct(
        private readonly ContentManagerInterface $manager,
    ) {
    }

    public function findBySlug(string $slug): Tutorial
    {
        return $this->manager->getContent(self::CLASS_NAME, $slug);
    }

    /**
     * @return array<string, Tutorial>
     */
    public function findPublished(): array
    {
        return $this->manager->getContents(self::CLASS_NAME, ['publishedAt' => false], '_.isPublished()');
    }

    /**
     * @return array<string, Tutorial>
     */
    public function findByTag(string $tag): array
    {
        return $this->manager->getContents(self::CLASS_NAME, ['publishedAt' => false], '_.isPublished() and "' . $tag . '" in _.tags');
    }

    /**
     * @return array<string, Tutorial>
     */
    public function findByAuthor(Author $author): array
    {
        return $this->manager->getContents(self::CLASS_NAME, ['publishedAt' => false], '_.isPublished() and "' . $author->slug . '" in _.authors');
    }

    /**
     * All chapters of the given tutorial, published or not (the summary
     * teases the upcoming ones), ordered by position.
     *
     * @return array<string, Chapter>
     */
    public function findChapters(Tutorial $tutorial): array
    {
        return $this->manager->getContents(self::CHAPTER_CLASS_NAME, ['position' => true], '_.getTutorialSlug() === "' . $tutorial->slug . '"');
    }

    /**
     * Published chapters belonging to published tutorials, ordered by position.
     *
     * @return array<string, Chapter>
     */
    public function findPublishedChapters(): array
    {
        $tutorialSlugs = array_keys($this->findPublished());

        return array_filter(
            $this->manager->getContents(self::CHAPTER_CLASS_NAME, ['position' => true], '_.isPublished()'),
            static fn (Chapter $chapter): bool => \in_array($chapter->getTutorialSlug(), $tutorialSlugs, true),
        );
    }
}

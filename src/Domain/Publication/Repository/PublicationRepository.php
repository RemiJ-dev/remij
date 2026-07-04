<?php

declare(strict_types=1);

namespace App\Domain\Publication\Repository;

use App\Domain\Article\Repository\ArticleRepository;
use App\Domain\Publication\DTO\FeedEntry;
use App\Domain\Publication\Model\Author;
use App\Domain\Publication\Model\PublicationInterface;
use App\Domain\Tutorial\Repository\TutorialRepository;

/**
 * Transversal, read-only view over every content type published on the
 * site (articles + tutorials). Composes the per-type repositories.
 */
readonly class PublicationRepository
{
    public function __construct(
        private ArticleRepository $articleRepository,
        private TutorialRepository $tutorialRepository,
        private AuthorRepository $authorRepository,
    ) {
    }

    /**
     * All published contents, most recent first.
     *
     * @return list<PublicationInterface>
     */
    public function findPublished(): array
    {
        return self::sortByMostRecent([
            ...array_values($this->articleRepository->findPublished()),
            ...array_values($this->tutorialRepository->findPublished()),
        ]);
    }

    /**
     * @return list<PublicationInterface>
     */
    public function findByTag(string $tag): array
    {
        return self::sortByMostRecent([
            ...array_values($this->articleRepository->findByTag($tag)),
            ...array_values($this->tutorialRepository->findByTag($tag)),
        ]);
    }

    /**
     * @return list<PublicationInterface>
     */
    public function findByAuthor(Author $author): array
    {
        return self::sortByMostRecent([
            ...array_values($this->articleRepository->findByAuthor($author)),
            ...array_values($this->tutorialRepository->findByAuthor($author)),
        ]);
    }

    /**
     * Tags of the published contents, each with the date of the most
     * recently modified content carrying it.
     *
     * @return array<string, \DateTimeInterface>
     */
    public function findTags(): array
    {
        $tags = [];
        foreach ($this->findPublished() as $publication) {
            $date = $publication->getLastModifiedOrCreated();
            foreach ($publication->tags as $tag) {
                if (!isset($tags[$tag]) || $date > $tags[$tag]) {
                    $tags[$tag] = $date;
                }
            }
        }

        return $tags;
    }

    /**
     * Author slugs of the published contents, each with the date of the
     * most recently modified content they signed.
     *
     * @return array<string, \DateTimeInterface>
     */
    public function findAuthors(): array
    {
        $authors = [];
        foreach ($this->findPublished() as $publication) {
            $date = $publication->getLastModifiedOrCreated();
            foreach ($publication->authors as $authorSlug) {
                if (!isset($authors[$authorSlug]) || $date > $authors[$authorSlug]) {
                    $authors[$authorSlug] = $date;
                }
            }
        }

        return $authors;
    }

    /**
     * Entries of the Atom feed: published articles and tutorials, plus the
     * published chapters of published tutorials. Most recent first.
     *
     * @return list<FeedEntry>
     */
    public function findFeedEntries(): array
    {
        $authors = $this->authorRepository->findAll();

        $entries = [];

        foreach ($this->articleRepository->findPublished() as $article) {
            $entries[] = FeedEntry::fromPublication($article, self::resolveAuthorNames($article->authors, $authors));
        }

        foreach ($this->tutorialRepository->findPublished() as $tutorial) {
            $authorNames = self::resolveAuthorNames($tutorial->authors, $authors);
            $entries[] = FeedEntry::fromPublication($tutorial, $authorNames);

            foreach ($this->tutorialRepository->findChapters($tutorial) as $chapter) {
                if (!$chapter->isPublished()) {
                    continue;
                }

                $entries[] = FeedEntry::fromChapter($chapter, $tutorial, $authorNames);
            }
        }

        usort($entries, static fn (FeedEntry $a, FeedEntry $b): int => $b->publishedAt <=> $a->publishedAt);

        return $entries;
    }

    /**
     * @param list<PublicationInterface> $publications
     *
     * @return list<PublicationInterface>
     */
    private static function sortByMostRecent(array $publications): array
    {
        usort($publications, static fn (PublicationInterface $a, PublicationInterface $b): int => $b->publishedAt <=> $a->publishedAt);

        return $publications;
    }

    /**
     * @param array<int, string>    $slugs
     * @param array<string, Author> $authors
     *
     * @return array<int, string>
     */
    private static function resolveAuthorNames(array $slugs, array $authors): array
    {
        return array_map(
            static fn (string $slug): string => $authors[$slug]->name ?? $slug,
            $slugs,
        );
    }
}

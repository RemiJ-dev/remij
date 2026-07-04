<?php

declare(strict_types=1);

namespace App\Tests\Domain\Publication\Repository;

use App\Domain\Article\Model\Article;
use App\Domain\Article\Repository\ArticleRepository;
use App\Domain\Publication\Model\Author;
use App\Domain\Publication\Repository\AuthorRepository;
use App\Domain\Publication\Repository\PublicationRepository;
use App\Domain\Tutorial\Model\Chapter;
use App\Domain\Tutorial\Model\Tutorial;
use App\Domain\Tutorial\Repository\TutorialRepository;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;

#[CoversClass(PublicationRepository::class)]
class PublicationRepositoryTest extends TestCase
{
    public function testFindPublishedMergesArticlesAndTutorialsMostRecentFirst(): void
    {
        $oldArticle = self::article('vieil-article', '2025-01-01');
        $recentArticle = self::article('article-recent', '2025-08-01');
        $tutorial = self::tutorial('tuto', '2025-06-01');

        $articleRepository = self::createStub(ArticleRepository::class);
        $articleRepository->method('findPublished')->willReturn([
            'article-recent' => $recentArticle,
            'vieil-article' => $oldArticle,
        ]);

        $tutorialRepository = self::createStub(TutorialRepository::class);
        $tutorialRepository->method('findPublished')->willReturn(['tuto' => $tutorial]);

        $result = self::repository($articleRepository, $tutorialRepository)->findPublished();

        self::assertSame([$recentArticle, $tutorial, $oldArticle], $result);
    }

    public function testFindByTagMergesArticlesAndTutorials(): void
    {
        $article = self::article('article-php', '2025-01-01');
        $tutorial = self::tutorial('tuto-php', '2025-06-01');

        $articleRepository = self::createStub(ArticleRepository::class);
        $articleRepository->method('findByTag')->willReturn(['article-php' => $article]);

        $tutorialRepository = self::createStub(TutorialRepository::class);
        $tutorialRepository->method('findByTag')->willReturn(['tuto-php' => $tutorial]);

        $result = self::repository($articleRepository, $tutorialRepository)->findByTag('php');

        self::assertSame([$tutorial, $article], $result);
    }

    public function testFindByAuthorMergesArticlesAndTutorials(): void
    {
        $article = self::article('article-remij', '2025-06-01');
        $tutorial = self::tutorial('tuto-remij', '2025-01-01');

        $articleRepository = self::createStub(ArticleRepository::class);
        $articleRepository->method('findByAuthor')->willReturn(['article-remij' => $article]);

        $tutorialRepository = self::createStub(TutorialRepository::class);
        $tutorialRepository->method('findByAuthor')->willReturn(['tuto-remij' => $tutorial]);

        $result = self::repository($articleRepository, $tutorialRepository)->findByAuthor(new Author(slug: 'remij', name: 'RémiJ'));

        self::assertSame([$article, $tutorial], $result);
    }

    public function testFindTagsKeepsTheMostRecentDatePerTag(): void
    {
        $article = self::article('article-php', '2025-01-01', tags: ['php', 'symfony']);
        $tutorial = self::tutorial('tuto-php', '2025-06-01', tags: ['php']);

        $articleRepository = self::createStub(ArticleRepository::class);
        $articleRepository->method('findPublished')->willReturn(['article-php' => $article]);

        $tutorialRepository = self::createStub(TutorialRepository::class);
        $tutorialRepository->method('findPublished')->willReturn(['tuto-php' => $tutorial]);

        $tags = self::repository($articleRepository, $tutorialRepository)->findTags();

        self::assertSame(['php', 'symfony'], array_keys($tags));
        self::assertSame('2025-06-01', $tags['php']->format('Y-m-d'));
        self::assertSame('2025-01-01', $tags['symfony']->format('Y-m-d'));
    }

    public function testFindAuthorsKeepsTheMostRecentDatePerAuthor(): void
    {
        $article = self::article('article-1', '2025-01-01', authors: ['remij']);
        $tutorial = self::tutorial('tuto-1', '2025-06-01', authors: ['remij', 'invite']);

        $articleRepository = self::createStub(ArticleRepository::class);
        $articleRepository->method('findPublished')->willReturn(['article-1' => $article]);

        $tutorialRepository = self::createStub(TutorialRepository::class);
        $tutorialRepository->method('findPublished')->willReturn(['tuto-1' => $tutorial]);

        $authors = self::repository($articleRepository, $tutorialRepository)->findAuthors();

        self::assertSame(['remij', 'invite'], array_keys($authors));
        self::assertSame('2025-06-01', $authors['remij']->format('Y-m-d'));
    }

    public function testFindFeedEntriesMixesContentsAndResolvesAuthorNames(): void
    {
        $article = self::article('mon-article', '2025-03-01', authors: ['remij', 'inconnu']);
        $tutorial = self::tutorial('symfony-les-bases', '2025-01-01', authors: ['remij'], tags: ['symfony']);
        $publishedChapter = self::chapter('symfony-les-bases/architecture', 1, '2025-02-01');
        $draftChapter = self::chapter('symfony-les-bases/controllers', 2, '2099-01-01');

        $articleRepository = self::createStub(ArticleRepository::class);
        $articleRepository->method('findPublished')->willReturn(['mon-article' => $article]);

        $tutorialRepository = self::createStub(TutorialRepository::class);
        $tutorialRepository->method('findPublished')->willReturn(['symfony-les-bases' => $tutorial]);
        $tutorialRepository->method('findChapters')->willReturn([
            'symfony-les-bases/architecture' => $publishedChapter,
            'symfony-les-bases/controllers' => $draftChapter,
        ]);

        $authorRepository = self::createStub(AuthorRepository::class);
        $authorRepository->method('findAll')->willReturn([
            'remij' => new Author(slug: 'remij', name: 'RémiJ'),
        ]);

        $entries = self::repository($articleRepository, $tutorialRepository, $authorRepository)->findFeedEntries();

        self::assertCount(3, $entries, 'The draft chapter must not be part of the feed.');

        self::assertSame(
            ['mon-article', 'symfony-les-bases/architecture', 'symfony-les-bases'],
            array_map(static fn ($entry): string => $entry->routeParams['slug'], $entries),
            'Entries are ordered by publication date, most recent first.',
        );

        self::assertSame(['RémiJ', 'inconnu'], $entries[0]->authors, 'Author names are resolved, unknown slugs are kept as-is.');
        self::assertSame('Symfony-les-bases : Symfony-les-bases/architecture', $entries[1]->title);
        self::assertSame(['symfony'], $entries[1]->tags);
    }

    private static function repository(
        ArticleRepository $articleRepository,
        TutorialRepository $tutorialRepository,
        ?AuthorRepository $authorRepository = null,
    ): PublicationRepository {
        return new PublicationRepository(
            $articleRepository,
            $tutorialRepository,
            $authorRepository ?? self::createStub(AuthorRepository::class),
        );
    }

    /**
     * @param array<int, string> $authors
     * @param array<int, string> $tags
     */
    private static function article(string $slug, string $publishedAt, array $authors = [], array $tags = []): Article
    {
        return new Article(
            slug: $slug,
            title: ucfirst($slug),
            description: null,
            content: '',
            nextArticle: null,
            authors: $authors,
            tags: $tags,
            publishedAt: new \DateTimeImmutable($publishedAt),
        );
    }

    /**
     * @param array<int, string> $authors
     * @param array<int, string> $tags
     */
    private static function tutorial(string $slug, string $publishedAt, array $authors = [], array $tags = []): Tutorial
    {
        return new Tutorial(
            slug: $slug,
            title: ucfirst($slug),
            description: null,
            content: '',
            authors: $authors,
            tags: $tags,
            publishedAt: new \DateTimeImmutable($publishedAt),
        );
    }

    private static function chapter(string $slug, int $position, string $publishedAt): Chapter
    {
        return new Chapter(
            slug: $slug,
            title: ucfirst($slug),
            description: null,
            content: '',
            position: $position,
            publishedAt: new \DateTimeImmutable($publishedAt),
        );
    }
}

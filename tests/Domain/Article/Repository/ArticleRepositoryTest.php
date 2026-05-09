<?php

declare(strict_types=1);

namespace App\Tests\Domain\Article\Repository;

use App\Domain\Article\Model\Article;
use App\Domain\Article\Model\Author;
use App\Domain\Article\Repository\ArticleRepository;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;
use Stenope\Bundle\ContentManagerInterface;

#[CoversClass(ArticleRepository::class)]
class ArticleRepositoryTest extends TestCase
{
    public function testFindPublished(): void
    {
        $published1 = new Article(slug: 'published-1', title: 'Published 1', description: null, content: '', nextArticle: null, authors: [], tags: [], publishedAt: new \DateTimeImmutable('2025-01-01'));
        $published2 = new Article(slug: 'published-2', title: 'Published 2', description: null, content: '', nextArticle: null, authors: [], tags: [], publishedAt: new \DateTimeImmutable('2025-06-01'));
        $draft = new Article(slug: 'draft-1', title: 'Draft', description: null, content: '', nextArticle: null, authors: [], tags: [], publishedAt: new \DateTimeImmutable('2099-01-01'));

        $allArticles = ['published-1' => $published1, 'published-2' => $published2, 'draft-1' => $draft];

        $manager = self::createMock(ContentManagerInterface::class);
        $manager->expects(self::once())
            ->method('getContents')
            ->with(Article::class, ['publishedAt' => false], '_.isPublished()')
            ->willReturnCallback(static fn () => array_filter(
                $allArticles,
                static fn (Article $article) => $article->isPublished(),
            ));

        $result = new ArticleRepository($manager)->findPublished();

        self::assertCount(2, $result);
        self::assertArrayHasKey('published-1', $result);
        self::assertArrayHasKey('published-2', $result);
        self::assertArrayNotHasKey('draft-1', $result);
    }

    public function testFindByTag(): void
    {
        $phpAndSymfony = new Article(slug: 'php-symfony', title: 'PHP & Symfony', description: null, content: '', nextArticle: null, authors: [], tags: ['php', 'symfony'], publishedAt: new \DateTimeImmutable('2025-01-01'));
        $javascript = new Article(slug: 'javascript', title: 'JavaScript', description: null, content: '', nextArticle: null, authors: [], tags: ['javascript'], publishedAt: new \DateTimeImmutable('2025-02-01'));
        $phpOnly = new Article(slug: 'php-only', title: 'PHP Only', description: null, content: '', nextArticle: null, authors: [], tags: ['php'], publishedAt: new \DateTimeImmutable('2025-03-01'));

        $allArticles = ['php-symfony' => $phpAndSymfony, 'javascript' => $javascript, 'php-only' => $phpOnly];

        $manager = self::createMock(ContentManagerInterface::class);
        $manager->expects(self::once())
            ->method('getContents')
            ->with(Article::class, ['publishedAt' => false], '_.isPublished() and "php" in _.tags')
            ->willReturnCallback(static fn () => array_filter(
                $allArticles,
                static fn (Article $article) => \in_array('php', $article->tags, true),
            ));

        $result = new ArticleRepository($manager)->findByTag('php');

        self::assertCount(2, $result);
        self::assertArrayHasKey('php-symfony', $result);
        self::assertArrayHasKey('php-only', $result);
        self::assertArrayNotHasKey('javascript', $result);
    }

    public function testFindByAuthor(): void
    {
        $author = new Author(slug: 'remij', name: 'Rémi');

        $byRemij = new Article(slug: 'by-remij', title: 'By Remij', description: null, content: '', nextArticle: null, authors: ['remij'], tags: [], publishedAt: new \DateTimeImmutable('2025-01-01'));
        $byTest = new Article(slug: 'by-test', title: 'By Test', description: null, content: '', nextArticle: null, authors: ['test'], tags: [], publishedAt: new \DateTimeImmutable('2025-02-01'));
        $byBoth = new Article(slug: 'by-both', title: 'By Both', description: null, content: '', nextArticle: null, authors: ['remij', 'test'], tags: [], publishedAt: new \DateTimeImmutable('2025-03-01'));

        $allArticles = ['by-remij' => $byRemij, 'by-test' => $byTest, 'by-both' => $byBoth];

        $manager = self::createMock(ContentManagerInterface::class);
        $manager->expects(self::once())
            ->method('getContents')
            ->with(Article::class, ['publishedAt' => false], '_.isPublished() and "remij" in _.authors')
            ->willReturnCallback(static fn () => array_filter(
                $allArticles,
                static fn (Article $article) => \in_array('remij', $article->authors, true),
            ));

        $result = new ArticleRepository($manager)->findByAuthor($author);

        self::assertCount(2, $result);
        self::assertArrayHasKey('by-remij', $result);
        self::assertArrayHasKey('by-both', $result);
        self::assertArrayNotHasKey('by-test', $result);
    }
}

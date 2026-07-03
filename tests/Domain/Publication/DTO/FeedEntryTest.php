<?php

declare(strict_types=1);

namespace App\Tests\Domain\Publication\DTO;

use App\Domain\Article\Model\Article;
use App\Domain\Publication\DTO\FeedEntry;
use App\Domain\Tutorial\Model\Chapter;
use App\Domain\Tutorial\Model\Tutorial;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;

#[CoversClass(FeedEntry::class)]
class FeedEntryTest extends TestCase
{
    public function testFromPublicationWithArticle(): void
    {
        $publishedAt = new \DateTimeImmutable('2025-01-01');
        $lastModified = new \DateTimeImmutable('2025-02-01');
        $article = new Article(
            slug: '2025/mon-article',
            title: 'Mon article',
            description: 'La description',
            content: '',
            nextArticle: null,
            authors: ['remij'],
            tags: ['php'],
            publishedAt: $publishedAt,
            lastModified: $lastModified,
        );

        $entry = FeedEntry::fromPublication($article, ['RémiJ']);

        self::assertSame('Mon article', $entry->title);
        self::assertSame('La description', $entry->description);
        self::assertSame('article_show', $entry->routeName);
        self::assertSame(['slug' => '2025/mon-article'], $entry->routeParams);
        self::assertSame($publishedAt, $entry->publishedAt);
        self::assertSame($lastModified, $entry->updated);
        self::assertSame(['RémiJ'], $entry->authors);
        self::assertSame(['php'], $entry->tags);
    }

    public function testFromPublicationWithTutorial(): void
    {
        $publishedAt = new \DateTimeImmutable('2025-01-01');
        $tutorial = new Tutorial(
            slug: 'symfony-les-bases',
            title: 'Symfony : les bases',
            description: null,
            content: '',
            authors: ['remij'],
            tags: ['symfony'],
            publishedAt: $publishedAt,
        );

        $entry = FeedEntry::fromPublication($tutorial, ['RémiJ']);

        self::assertSame('tutorial_show', $entry->routeName);
        self::assertSame(['slug' => 'symfony-les-bases'], $entry->routeParams);
        self::assertSame($publishedAt, $entry->updated, 'Without lastModified, updated falls back to publishedAt.');
    }

    public function testFromChapterInheritsTutorialTagsAndContextualizesTitle(): void
    {
        $tutorial = new Tutorial(
            slug: 'symfony-les-bases',
            title: 'Symfony : les bases',
            description: null,
            content: '',
            authors: ['remij'],
            tags: ['symfony'],
            publishedAt: new \DateTimeImmutable('2025-01-01'),
        );
        $chapter = new Chapter(
            slug: 'symfony-les-bases/architecture',
            title: "L'architecture",
            description: 'Les dossiers.',
            content: '',
            position: 1,
            publishedAt: new \DateTimeImmutable('2025-02-01'),
        );

        $entry = FeedEntry::fromChapter($chapter, $tutorial, ['RémiJ']);

        self::assertSame("Symfony : les bases : L'architecture", $entry->title);
        self::assertSame('Les dossiers.', $entry->description);
        self::assertSame('tutorial_chapter', $entry->routeName);
        self::assertSame(['slug' => 'symfony-les-bases/architecture'], $entry->routeParams);
        self::assertSame($chapter->publishedAt, $entry->publishedAt);
        self::assertSame(['RémiJ'], $entry->authors);
        self::assertSame(['symfony'], $entry->tags, 'A chapter inherits the tags of its tutorial.');
    }
}

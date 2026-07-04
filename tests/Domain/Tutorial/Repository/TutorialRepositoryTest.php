<?php

declare(strict_types=1);

namespace App\Tests\Domain\Tutorial\Repository;

use App\Domain\Publication\Model\Author;
use App\Domain\Tutorial\Model\Chapter;
use App\Domain\Tutorial\Model\Tutorial;
use App\Domain\Tutorial\Repository\TutorialRepository;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;
use Stenope\Bundle\ContentManagerInterface;

#[CoversClass(TutorialRepository::class)]
class TutorialRepositoryTest extends TestCase
{
    public function testFindBySlug(): void
    {
        $tutorial = self::tutorial('symfony-les-bases');

        $manager = self::createMock(ContentManagerInterface::class);
        $manager->expects(self::once())
            ->method('getContent')
            ->with(Tutorial::class, 'symfony-les-bases')
            ->willReturn($tutorial);

        self::assertSame($tutorial, new TutorialRepository($manager)->findBySlug('symfony-les-bases'));
    }

    public function testFindPublished(): void
    {
        $published = self::tutorial('published-1', publishedAt: '2025-01-01');
        $draft = self::tutorial('draft-1', publishedAt: '2099-01-01');

        $allTutorials = ['published-1' => $published, 'draft-1' => $draft];

        $manager = self::createMock(ContentManagerInterface::class);
        $manager->expects(self::once())
            ->method('getContents')
            ->with(Tutorial::class, ['publishedAt' => false], '_.isPublished()')
            ->willReturnCallback(static fn () => array_filter(
                $allTutorials,
                static fn (Tutorial $tutorial) => $tutorial->isPublished(),
            ));

        $result = new TutorialRepository($manager)->findPublished();

        self::assertCount(1, $result);
        self::assertArrayHasKey('published-1', $result);
        self::assertArrayNotHasKey('draft-1', $result);
    }

    public function testFindByTag(): void
    {
        $symfony = self::tutorial('symfony', tags: ['php', 'symfony']);
        $javascript = self::tutorial('javascript', tags: ['javascript']);

        $allTutorials = ['symfony' => $symfony, 'javascript' => $javascript];

        $manager = self::createMock(ContentManagerInterface::class);
        $manager->expects(self::once())
            ->method('getContents')
            ->with(Tutorial::class, ['publishedAt' => false], '_.isPublished() and "php" in _.tags')
            ->willReturnCallback(static fn () => array_filter(
                $allTutorials,
                static fn (Tutorial $tutorial) => \in_array('php', $tutorial->tags, true),
            ));

        $result = new TutorialRepository($manager)->findByTag('php');

        self::assertCount(1, $result);
        self::assertArrayHasKey('symfony', $result);
        self::assertArrayNotHasKey('javascript', $result);
    }

    public function testFindByAuthor(): void
    {
        $author = new Author(slug: 'remij', name: 'Rémi');

        $byRemij = self::tutorial('by-remij', authors: ['remij']);
        $byTest = self::tutorial('by-test', authors: ['test']);

        $allTutorials = ['by-remij' => $byRemij, 'by-test' => $byTest];

        $manager = self::createMock(ContentManagerInterface::class);
        $manager->expects(self::once())
            ->method('getContents')
            ->with(Tutorial::class, ['publishedAt' => false], '_.isPublished() and "remij" in _.authors')
            ->willReturnCallback(static fn () => array_filter(
                $allTutorials,
                static fn (Tutorial $tutorial) => \in_array('remij', $tutorial->authors, true),
            ));

        $result = new TutorialRepository($manager)->findByAuthor($author);

        self::assertCount(1, $result);
        self::assertArrayHasKey('by-remij', $result);
        self::assertArrayNotHasKey('by-test', $result);
    }

    public function testFindChaptersReturnsAllChaptersOfTheTutorialOrderedByPosition(): void
    {
        $tutorial = self::tutorial('symfony-les-bases');

        $chapter1 = self::chapter('symfony-les-bases/architecture', position: 1);
        $chapter2 = self::chapter('symfony-les-bases/controllers', position: 2, publishedAt: '2099-01-01');
        $other = self::chapter('autre-serie/intro', position: 1);

        $allChapters = [
            'symfony-les-bases/architecture' => $chapter1,
            'symfony-les-bases/controllers' => $chapter2,
            'autre-serie/intro' => $other,
        ];

        $manager = self::createMock(ContentManagerInterface::class);
        $manager->expects(self::once())
            ->method('getContents')
            ->with(Chapter::class, ['position' => true], '_.getTutorialSlug() === "symfony-les-bases"')
            ->willReturnCallback(static fn () => array_filter(
                $allChapters,
                static fn (Chapter $chapter) => 'symfony-les-bases' === $chapter->getTutorialSlug(),
            ));

        $result = new TutorialRepository($manager)->findChapters($tutorial);

        self::assertCount(2, $result);
        self::assertArrayHasKey('symfony-les-bases/architecture', $result);
        self::assertArrayHasKey('symfony-les-bases/controllers', $result);
        self::assertArrayNotHasKey('autre-serie/intro', $result);
    }

    public function testFindPublishedChaptersExcludesChaptersOfUnpublishedTutorials(): void
    {
        $publishedTutorial = self::tutorial('serie-publiee', publishedAt: '2025-01-01');

        $chapterOfPublished = self::chapter('serie-publiee/intro', position: 1);
        $chapterOfDraft = self::chapter('serie-brouillon/intro', position: 1);

        $manager = self::createMock(ContentManagerInterface::class);
        $manager->expects(self::exactly(2))
            ->method('getContents')
            ->willReturnCallback(static fn (string $type) => match ($type) {
                Tutorial::class => ['serie-publiee' => $publishedTutorial],
                Chapter::class => [
                    'serie-publiee/intro' => $chapterOfPublished,
                    'serie-brouillon/intro' => $chapterOfDraft,
                ],
                default => [],
            });

        $result = new TutorialRepository($manager)->findPublishedChapters();

        self::assertCount(1, $result);
        self::assertArrayHasKey('serie-publiee/intro', $result);
        self::assertArrayNotHasKey('serie-brouillon/intro', $result);
    }

    /**
     * @param array<int, string> $authors
     * @param array<int, string> $tags
     */
    private static function tutorial(string $slug, array $authors = [], array $tags = [], string $publishedAt = '2025-01-01'): Tutorial
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

    private static function chapter(string $slug, int $position, string $publishedAt = '2025-01-01'): Chapter
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

<?php

declare(strict_types=1);

namespace App\Tests\Responder\Tutorial;

use App\Domain\Tutorial\Model\Chapter;
use App\Domain\Tutorial\Model\Tutorial;
use App\Responder\Tutorial\ChapterResponder;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;

#[CoversClass(ChapterResponder::class)]
class ChapterResponderTest extends TestCase
{
    public function testRespondRendersExpectedTemplateAndSetsLastModified(): void
    {
        $renderCalled = 0;
        $render = function (string $template, array $parameters) use (&$renderCalled): Response {
            ++$renderCalled;
            self::assertSame('tutorials/chapter.html.twig', $template);
            self::assertArrayHasKey('tutorial', $parameters);
            self::assertArrayHasKey('chapter', $parameters);
            self::assertArrayHasKey('previousChapter', $parameters);
            self::assertArrayHasKey('nextChapter', $parameters);

            return new Response('<html>chapter</html>');
        };

        $chapter = self::chapter('serie/premiere', position: 1);

        $response = self::responder($render)(self::tutorial(), $chapter, ['serie/premiere' => $chapter]);

        self::assertSame(1, $renderCalled);
        self::assertSame('<html>chapter</html>', $response->getContent());
        self::assertNotNull($response->getLastModified());
        self::assertSame($chapter->publishedAt->format('U'), $response->getLastModified()->format('U'));
    }

    public function testRespondComputesPreviousAndNextAmongPublishedChapters(): void
    {
        $first = self::chapter('serie/premiere', position: 1);
        $draft = self::chapter('serie/brouillon', position: 2, publishedAt: '2099-01-01');
        $second = self::chapter('serie/deuxieme', position: 3);
        $third = self::chapter('serie/troisieme', position: 4);

        $chapters = [
            'serie/premiere' => $first,
            'serie/brouillon' => $draft,
            'serie/deuxieme' => $second,
            'serie/troisieme' => $third,
        ];

        $captured = [];
        $render = function (string $template, array $parameters) use (&$captured): Response {
            $captured = $parameters;

            return new Response('');
        };

        self::responder($render)(self::tutorial(), $second, $chapters);

        self::assertSame($first, $captured['previousChapter'], 'The unpublished chapter must be skipped.');
        self::assertSame($third, $captured['nextChapter']);
    }

    public function testRespondFirstChapterHasNoPrevious(): void
    {
        $first = self::chapter('serie/premiere', position: 1);
        $second = self::chapter('serie/deuxieme', position: 2);

        $captured = [];
        $render = function (string $template, array $parameters) use (&$captured): Response {
            $captured = $parameters;

            return new Response('');
        };

        self::responder($render)(self::tutorial(), $first, ['serie/premiere' => $first, 'serie/deuxieme' => $second]);

        self::assertNull($captured['previousChapter']);
        self::assertSame($second, $captured['nextChapter']);
    }

    public function testRespondUnpublishedChapterHasNoNavigation(): void
    {
        $first = self::chapter('serie/premiere', position: 1);
        $draft = self::chapter('serie/brouillon', position: 2, publishedAt: '2099-01-01');

        $captured = [];
        $render = function (string $template, array $parameters) use (&$captured): Response {
            $captured = $parameters;

            return new Response('');
        };

        self::responder($render)(self::tutorial(), $draft, ['serie/premiere' => $first, 'serie/brouillon' => $draft]);

        self::assertNull($captured['previousChapter']);
        self::assertNull($captured['nextChapter']);
    }

    /**
     * @param \Closure(string, array<string, mixed>): Response $render
     */
    private static function responder(\Closure $render): ChapterResponder
    {
        return new ChapterResponder(static fn () => null, static fn (): RedirectResponse => new RedirectResponse('/'), $render);
    }

    private static function tutorial(): Tutorial
    {
        return new Tutorial(
            slug: 'serie',
            title: 'Série',
            description: null,
            content: '',
            authors: [],
            tags: [],
            publishedAt: new \DateTimeImmutable('2025-01-01'),
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

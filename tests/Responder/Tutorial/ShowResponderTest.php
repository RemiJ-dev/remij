<?php

declare(strict_types=1);

namespace App\Tests\Responder\Tutorial;

use App\Domain\Tutorial\Model\Chapter;
use App\Domain\Tutorial\Model\Tutorial;
use App\Responder\Tutorial\ShowResponder;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;

#[CoversClass(ShowResponder::class)]
class ShowResponderTest extends TestCase
{
    public function testRespondRendersExpectedTemplate(): void
    {
        $renderCalled = 0;
        $render = function (string $template, array $parameters) use (&$renderCalled): Response {
            ++$renderCalled;
            self::assertSame('tutorials/show.html.twig', $template);
            self::assertArrayHasKey('tutorial', $parameters);
            self::assertArrayHasKey('chapters', $parameters);

            return new Response('<html>show</html>');
        };

        $response = new ShowResponder(static fn () => null, static fn (): RedirectResponse => new RedirectResponse('/'), $render)(self::tutorial(), []);

        self::assertSame(1, $renderCalled);
        self::assertSame('<html>show</html>', $response->getContent());
    }

    public function testRespondSetsLastModifiedFromTutorialAndChapters(): void
    {
        $render = static fn (string $template, array $parameters): Response => new Response('');

        $chapterLastModified = new \DateTimeImmutable('2025-06-01 10:00:00');
        $chapter = new Chapter(
            slug: 'symfony-les-bases/architecture',
            title: 'Architecture',
            description: null,
            content: '',
            position: 1,
            publishedAt: new \DateTimeImmutable('2025-02-01'),
            lastModified: $chapterLastModified,
        );

        $response = new ShowResponder(static fn () => null, static fn (): RedirectResponse => new RedirectResponse('/'), $render)(self::tutorial(), ['symfony-les-bases/architecture' => $chapter]);

        self::assertNotNull($response->getLastModified());
        self::assertSame($chapterLastModified->format('U'), $response->getLastModified()->format('U'));
    }

    private static function tutorial(): Tutorial
    {
        return new Tutorial(
            slug: 'symfony-les-bases',
            title: 'Symfony : les bases',
            description: null,
            content: '',
            authors: [],
            tags: [],
            publishedAt: new \DateTimeImmutable('2025-01-01'),
        );
    }
}

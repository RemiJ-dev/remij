<?php

declare(strict_types=1);

namespace App\Tests\Responder\Publication;

use App\Domain\Article\Model\Article;
use App\Responder\Publication\ListByTagResponder;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;

#[CoversClass(ListByTagResponder::class)]
class ListByTagResponderTest extends TestCase
{
    public function testRespondRendersExpectedTemplate(): void
    {
        $renderCalled = 0;
        $render = function (string $template, array $parameters) use (&$renderCalled): Response {
            ++$renderCalled;
            self::assertSame('publications/list_by_tag.html.twig', $template);
            self::assertArrayHasKey('publications', $parameters);
            self::assertSame('php', $parameters['tag']);

            return new Response('<html>tag</html>');
        };

        $response = new ListByTagResponder(static fn () => null, static fn (): RedirectResponse => new RedirectResponse('/'), $render)->respond('php', []);

        self::assertSame(1, $renderCalled);
        self::assertSame('<html>tag</html>', $response->getContent());
        self::assertNull($response->getLastModified());
    }

    public function testRespondSetsLastModifiedFromPublications(): void
    {
        $render = static fn (string $template, array $parameters): Response => new Response('');

        $lastModified = new \DateTimeImmutable('2025-03-01 09:00:00');
        $article = new Article(
            slug: '2025-03-article',
            title: 'Test',
            description: null,
            content: '',
            nextArticle: null,
            authors: [],
            tags: ['php'],
            publishedAt: $lastModified,
            lastModified: $lastModified,
        );

        $response = new ListByTagResponder(static fn () => null, static fn (): RedirectResponse => new RedirectResponse('/'), $render)->respond('php', [$article]);

        self::assertNotNull($response->getLastModified());
        self::assertSame($lastModified->format('U'), $response->getLastModified()->format('U'));
    }
}

<?php

declare(strict_types=1);

namespace App\Tests\Responder\Article;

use App\Domain\Article\Model\Article;
use App\Responder\Article\ListByTagResponder;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Response;

#[CoversClass(ListByTagResponder::class)]
class ListByTagResponderTest extends TestCase
{
    public function testInvokeRendersExpectedTemplate(): void
    {
        $renderCalled = 0;
        $render = function (string $template, array $parameters) use (&$renderCalled): Response {
            ++$renderCalled;
            self::assertSame('articles/list_by_tag.html.twig', $template);
            self::assertSame('symfony', $parameters['tag']);
            self::assertArrayHasKey('articles', $parameters);

            return new Response('<html>articles</html>');
        };

        $response = new ListByTagResponder($render)('symfony', []);

        self::assertSame(1, $renderCalled);
        self::assertInstanceOf(Response::class, $response);
        self::assertSame('<html>articles</html>', $response->getContent());
        self::assertNull($response->getLastModified());
    }

    public function testInvokeSetsLastModifiedFromArticles(): void
    {
        $render = static fn (string $template, array $parameters): Response => new Response('');

        $lastModified = new \DateTimeImmutable('2025-01-15 12:00:00');
        $article = new Article(
            slug: '2025-01-article',
            title: 'Test',
            description: null,
            content: '',
            nextArticle: null,
            authors: [],
            tags: ['php'],
            publishedAt: $lastModified,
            lastModified: $lastModified,
        );

        $response = new ListByTagResponder($render)('php', ['2025-01-article' => $article]);

        self::assertNotNull($response->getLastModified());
        self::assertSame($lastModified->format('U'), $response->getLastModified()->format('U'));
    }
}

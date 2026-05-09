<?php

declare(strict_types=1);

namespace App\Tests\Responder\Article;

use App\Domain\Article\Model\Article;
use App\Responder\Article\ListResponder;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Response;

#[CoversClass(ListResponder::class)]
class ListResponderTest extends TestCase
{
    public function testInvokeRendersExpectedTemplate(): void
    {
        $renderCalled = 0;
        $render = function (string $template, array $parameters) use (&$renderCalled): Response {
            ++$renderCalled;
            self::assertSame('articles/list.html.twig', $template);
            self::assertArrayHasKey('articles', $parameters);

            return new Response('<html>list</html>');
        };

        $response = new ListResponder($render)([]);

        self::assertSame(1, $renderCalled);
        self::assertInstanceOf(Response::class, $response);
        self::assertSame('<html>list</html>', $response->getContent());
        self::assertNull($response->getLastModified());
    }

    public function testInvokeSetsLastModifiedFromArticles(): void
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
            tags: [],
            publishedAt: $lastModified,
            lastModified: $lastModified,
        );

        $response = new ListResponder($render)(['2025-03-article' => $article]);

        self::assertNotNull($response->getLastModified());
        self::assertSame($lastModified->format('U'), $response->getLastModified()->format('U'));
    }
}

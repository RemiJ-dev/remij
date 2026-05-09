<?php

declare(strict_types=1);

namespace App\Tests\Responder\Article;

use App\Domain\Article\Model\Article;
use App\Responder\Article\ShowResponder;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Response;

#[CoversClass(ShowResponder::class)]
class ShowResponderTest extends TestCase
{
    public function testInvokeRendersExpectedTemplate(): void
    {
        $renderCalled = 0;
        $render = function (string $template, array $parameters) use (&$renderCalled): Response {
            ++$renderCalled;
            self::assertSame('articles/show.html.twig', $template);
            self::assertArrayHasKey('article', $parameters);

            return new Response('<html>article</html>');
        };

        $publishedAt = new \DateTimeImmutable('2025-01-10');
        $article = new Article(
            slug: '2025-01-test',
            title: 'Test',
            description: null,
            content: '',
            nextArticle: null,
            authors: [],
            tags: [],
            publishedAt: $publishedAt,
        );

        $response = new ShowResponder($render)($article);

        self::assertSame(1, $renderCalled);
        self::assertInstanceOf(Response::class, $response);
        self::assertSame('<html>article</html>', $response->getContent());
    }

    public function testInvokeSetsLastModifiedFromArticle(): void
    {
        $render = static fn (string $template, array $parameters): Response => new Response('');

        $lastModified = new \DateTimeImmutable('2025-04-15 14:00:00');
        $article = new Article(
            slug: '2025-04-test',
            title: 'Test',
            description: null,
            content: '',
            nextArticle: null,
            authors: [],
            tags: [],
            publishedAt: new \DateTimeImmutable('2025-01-01'),
            lastModified: $lastModified,
        );

        $response = new ShowResponder($render)($article);

        self::assertNotNull($response->getLastModified());
        self::assertSame($lastModified->format('U'), $response->getLastModified()->format('U'));
    }
}

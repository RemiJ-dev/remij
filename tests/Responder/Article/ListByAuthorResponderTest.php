<?php

declare(strict_types=1);

namespace App\Tests\Responder\Article;

use App\Domain\Article\Model\Article;
use App\Domain\Article\Model\Author;
use App\Responder\Article\ListByAuthorResponder;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Response;

#[CoversClass(ListByAuthorResponder::class)]
class ListByAuthorResponderTest extends TestCase
{
    public function testInvokeRendersExpectedTemplate(): void
    {
        $renderCalled = 0;
        $render = function (string $template, array $parameters) use (&$renderCalled): Response {
            ++$renderCalled;
            self::assertSame('articles/list_by_author.html.twig', $template);
            self::assertArrayHasKey('author', $parameters);
            self::assertArrayHasKey('articles', $parameters);

            return new Response('<html>articles</html>');
        };

        $author = new Author(slug: 'remij', name: 'Rémi J.');
        $response = new ListByAuthorResponder($render)($author, []);

        self::assertSame(1, $renderCalled);
        self::assertInstanceOf(Response::class, $response);
        self::assertSame('<html>articles</html>', $response->getContent());
        self::assertNull($response->getLastModified());
    }

    public function testInvokeSetsLastModifiedFromArticles(): void
    {
        $render = static fn (string $template, array $parameters): Response => new Response('');

        $author = new Author(slug: 'remij', name: 'Rémi J.');

        $lastModified = new \DateTimeImmutable('2025-06-01 10:00:00');
        $article = new Article(
            slug: 'remij-2025-06-article',
            title: 'Test',
            description: null,
            content: '',
            nextArticle: null,
            authors: ['remij'],
            tags: [],
            publishedAt: $lastModified,
            lastModified: $lastModified,
        );

        $response = new ListByAuthorResponder($render)($author, ['remij-2025-06-article' => $article]);

        self::assertNotNull($response->getLastModified());
        self::assertSame($lastModified->format('U'), $response->getLastModified()->format('U'));
    }
}

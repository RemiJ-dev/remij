<?php

declare(strict_types=1);

namespace App\Tests\Responder\Article;

use App\Domain\Article\Model\Author;
use App\Responder\Article\ListByAuthorResponder;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

#[CoversClass(ListByAuthorResponder::class)]
class ListByAuthorResponderTest extends TestCase
{
    /**
     * @throws RuntimeError
     * @throws SyntaxError
     * @throws LoaderError
     */
    public function testInvokeRendersExpectedTemplate(): void
    {
        $twig = $this->createMock(Environment::class);
        $twig
            ->expects($this->once())
            ->method('render')
            ->with(
                'articles/list_by_author.html.twig',
                self::callback(fn (array $context): bool => isset($context['author'], $context['articles']))
            )
            ->willReturn('<html>articles</html>');

        $author = new Author(slug: 'remij', name: 'Rémi J.');
        $response = (new ListByAuthorResponder($twig))($author, []);

        self::assertInstanceOf(Response::class, $response);
        self::assertSame('<html>articles</html>', $response->getContent());
        self::assertNull($response->getLastModified());
    }

    public function testInvokeSetsLastModifiedFromArticles(): void
    {
        $twig = self::createStub(Environment::class);
        $twig->method('render')->willReturn('');

        $author = new Author(slug: 'remij', name: 'Rémi J.');

        $lastModified = new \DateTimeImmutable('2025-06-01 10:00:00');
        $article = new \App\Domain\Article\Model\Article(
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

        $response = (new ListByAuthorResponder($twig))($author, ['remij-2025-06-article' => $article]);

        self::assertNotNull($response->getLastModified());
        self::assertSame($lastModified->format('U'), $response->getLastModified()->format('U'));
    }
}

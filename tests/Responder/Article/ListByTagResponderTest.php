<?php

declare(strict_types=1);

namespace App\Tests\Responder\Article;

use App\Responder\Article\ListByTagResponder;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;

#[CoversClass(ListByTagResponder::class)]
class ListByTagResponderTest extends TestCase
{
    public function testInvokeRendersExpectedTemplate(): void
    {
        $twig = $this->createMock(Environment::class);
        $twig
            ->expects($this->once())
            ->method('render')
            ->with(
                'articles/list_by_tag.html.twig',
                self::callback(fn (array $context): bool => 'symfony' === $context['tag'] && isset($context['articles'])
                )
            )
            ->willReturn('<html>articles</html>');

        $response = (new ListByTagResponder($twig))('symfony', []);

        self::assertInstanceOf(Response::class, $response);
        self::assertSame('<html>articles</html>', $response->getContent());
        self::assertNull($response->getLastModified());
    }

    public function testInvokeSetsLastModifiedFromArticles(): void
    {
        $twig = self::createStub(Environment::class);
        $twig->method('render')->willReturn('');

        $lastModified = new \DateTimeImmutable('2025-01-15 12:00:00');
        $article = new \App\Domain\Article\Model\Article(
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

        $response = (new ListByTagResponder($twig))('php', ['2025-01-article' => $article]);

        self::assertNotNull($response->getLastModified());
        self::assertSame($lastModified->format('U'), $response->getLastModified()->format('U'));
    }
}

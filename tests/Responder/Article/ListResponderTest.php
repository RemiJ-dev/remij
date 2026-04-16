<?php

declare(strict_types=1);

namespace App\Tests\Responder\Article;

use App\Domain\Article\Model\Article;
use App\Responder\Article\ListResponder;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;

#[CoversClass(ListResponder::class)]
class ListResponderTest extends TestCase
{
    public function testInvokeRendersExpectedTemplate(): void
    {
        $twig = $this->createMock(Environment::class);
        $twig
            ->expects($this->once())
            ->method('render')
            ->with('articles/list.html.twig', self::callback(fn (array $context): bool => isset($context['articles'])))
            ->willReturn('<html>list</html>');

        $response = (new ListResponder($twig))([]);

        self::assertInstanceOf(Response::class, $response);
        self::assertSame('<html>list</html>', $response->getContent());
        self::assertNull($response->getLastModified());
    }

    public function testInvokeSetsLastModifiedFromArticles(): void
    {
        $twig = self::createStub(Environment::class);
        $twig->method('render')->willReturn('');

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

        $response = (new ListResponder($twig))(['2025-03-article' => $article]);

        self::assertNotNull($response->getLastModified());
        self::assertSame($lastModified->format('U'), $response->getLastModified()->format('U'));
    }
}

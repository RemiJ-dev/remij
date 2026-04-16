<?php

declare(strict_types=1);

namespace App\Tests\Responder\Article;

use App\Domain\Article\Model\Article;
use App\Responder\Article\ShowResponder;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;

#[CoversClass(ShowResponder::class)]
class ShowResponderTest extends TestCase
{
    public function testInvokeRendersExpectedTemplate(): void
    {
        $twig = $this->createMock(Environment::class);
        $twig
            ->expects($this->once())
            ->method('render')
            ->with('articles/show.html.twig', self::callback(fn (array $context): bool => isset($context['article'])))
            ->willReturn('<html>article</html>');

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

        $response = (new ShowResponder($twig))($article);

        self::assertInstanceOf(Response::class, $response);
        self::assertSame('<html>article</html>', $response->getContent());
    }

    public function testInvokeSetsLastModifiedFromArticle(): void
    {
        $twig = self::createStub(Environment::class);
        $twig->method('render')->willReturn('');

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

        $response = (new ShowResponder($twig))($article);

        self::assertNotNull($response->getLastModified());
        self::assertSame($lastModified->format('U'), $response->getLastModified()->format('U'));
    }
}

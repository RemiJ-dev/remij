<?php

declare(strict_types=1);

namespace App\Tests\Responder\Article;

use App\Domain\Article\Model\Article;
use App\Responder\Article\RssResponder;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;
use Twig\Environment;

#[CoversClass(RssResponder::class)]
class RssResponderTest extends TestCase
{
    public function testInvokeSetsAtomContentType(): void
    {
        $twig = self::createStub(Environment::class);
        $twig->method('render')->willReturn('');

        $response = (new RssResponder($twig))([]);

        self::assertSame('application/atom+xml; charset=utf-8', $response->headers->get('Content-Type'));
    }

    public function testInvokeSetsLastModifiedFromArticles(): void
    {
        $twig = self::createStub(Environment::class);
        $twig->method('render')->willReturn('');

        $lastModified = new \DateTimeImmutable('2025-05-01 08:00:00');
        $article = new Article(
            slug: '2025-05-article', title: 'Test', description: null, content: '',
            nextArticle: null, authors: [], tags: [], publishedAt: $lastModified, lastModified: $lastModified,
        );

        $response = (new RssResponder($twig))(['2025-05-article' => $article]);

        self::assertNotNull($response->getLastModified());
        self::assertSame($lastModified->format('U'), $response->getLastModified()->format('U'));
    }
}

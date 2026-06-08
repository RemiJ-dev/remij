<?php

declare(strict_types=1);

namespace App\Tests\Responder\Article;

use App\Domain\Article\Model\Article;
use App\Responder\Article\RssResponder;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Response;

#[CoversClass(RssResponder::class)]
class RssResponderTest extends TestCase
{
    public function testRespondSetsAtomContentType(): void
    {
        $render = static fn (string $template, array $parameters): Response => new Response('');

        $response = (new RssResponder($render))->respond([]);

        self::assertSame('application/atom+xml; charset=utf-8', $response->headers->get('Content-Type'));
    }

    public function testRespondSetsLastModifiedFromArticles(): void
    {
        $render = static fn (string $template, array $parameters): Response => new Response('');

        $lastModified = new \DateTimeImmutable('2025-05-01 08:00:00');
        $article = new Article(
            slug: '2025-05-article', title: 'Test', description: null, content: '',
            nextArticle: null, authors: [], tags: [], publishedAt: $lastModified, lastModified: $lastModified,
        );

        $response = (new RssResponder($render))->respond(['2025-05-article' => $article]);

        self::assertNotNull($response->getLastModified());
        self::assertSame($lastModified->format('U'), $response->getLastModified()->format('U'));
    }
}

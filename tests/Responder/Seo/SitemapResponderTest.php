<?php

declare(strict_types=1);

namespace App\Tests\Responder\Seo;

use App\Domain\Article\Model\Article;
use App\Responder\Seo\SitemapResponder;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;
use Twig\Environment;

#[CoversClass(SitemapResponder::class)]
class SitemapResponderTest extends TestCase
{
    public function testInvokeSetsXmlContentType(): void
    {
        $twig = self::createStub(Environment::class);
        $twig->method('render')->willReturn('');

        $response = (new SitemapResponder($twig))([], []);

        self::assertSame('application/xml; charset=utf-8', $response->headers->get('Content-Type'));
    }

    public function testInvokeAggregatesTagsAndAuthorsFromArticles(): void
    {
        $date1 = new \DateTimeImmutable('2025-01-01');
        $date2 = new \DateTimeImmutable('2025-06-01');

        $article1 = new Article(
            slug: 'a1', title: 'A1', description: null, content: '', nextArticle: null,
            authors: ['remij'], tags: ['php', 'symfony'], publishedAt: $date1,
        );
        $article2 = new Article(
            slug: 'a2', title: 'A2', description: null, content: '', nextArticle: null,
            authors: ['remij'], tags: ['php'], publishedAt: $date2,
        );

        /** @var array<string, mixed> $capturedContext */
        $capturedContext = [];
        $twig = self::createStub(Environment::class);
        $twig->method('render')->willReturnCallback(
            function (string $template, array $context) use (&$capturedContext): string {
                $capturedContext = $context;

                return '';
            }
        );

        (new SitemapResponder($twig))([$article1->slug => $article1, $article2->slug => $article2], []);

        /** @var array<string, \DateTimeInterface> $tags */
        $tags = $capturedContext['tags'];
        /** @var array<string, \DateTimeInterface> $authors */
        $authors = $capturedContext['authors'];

        self::assertArrayHasKey('php', $tags);
        self::assertArrayHasKey('symfony', $tags);
        self::assertArrayHasKey('remij', $authors);
        self::assertSame($date2->format('U'), $tags['php']->format('U'));
    }
}

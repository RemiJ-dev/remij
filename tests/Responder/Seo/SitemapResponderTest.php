<?php

declare(strict_types=1);

namespace App\Tests\Responder\Seo;

use App\Domain\Article\Model\Article;
use App\Domain\Tutorial\Model\Chapter;
use App\Domain\Tutorial\Model\Tutorial;
use App\Responder\Seo\SitemapResponder;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;

#[CoversClass(SitemapResponder::class)]
class SitemapResponderTest extends TestCase
{
    public function testRespondSetsXmlContentType(): void
    {
        $render = static fn (string $template, array $parameters): Response => new Response('');

        $response = new SitemapResponder(static fn () => null, static fn (): RedirectResponse => new RedirectResponse('/'), $render)->respond([], [], [], [], [], []);

        self::assertSame('application/xml; charset=utf-8', $response->headers->get('Content-Type'));
    }

    public function testRespondPassesContentsAndComputedLastModifiedToTemplate(): void
    {
        $article = new Article(
            slug: 'a1', title: 'A1', description: null, content: '', nextArticle: null,
            authors: ['remij'], tags: ['php'], publishedAt: new \DateTimeImmutable('2025-01-01'),
        );
        $tutorial = new Tutorial(
            slug: 't1', title: 'T1', description: null, content: '',
            authors: ['remij'], tags: ['symfony'], publishedAt: new \DateTimeImmutable('2025-02-01'),
        );
        $chapter = new Chapter(
            slug: 't1/c1', title: 'C1', description: null, content: '',
            position: 1, publishedAt: new \DateTimeImmutable('2025-03-01'),
        );
        $tags = ['php' => new \DateTimeImmutable('2025-01-01')];
        $authors = ['remij' => new \DateTimeImmutable('2025-02-01')];

        /** @var array<string, mixed> $capturedContext */
        $capturedContext = [];
        $render = static function (string $template, array $parameters) use (&$capturedContext): Response {
            $capturedContext = $parameters;

            return new Response('');
        };

        new SitemapResponder(static fn () => null, static fn (): RedirectResponse => new RedirectResponse('/'), $render)
            ->respond(['a1' => $article], ['t1' => $tutorial], ['t1/c1' => $chapter], [], $tags, $authors);

        self::assertSame(['a1' => $article], $capturedContext['articles']);
        self::assertSame(['t1' => $tutorial], $capturedContext['tutorials']);
        self::assertSame(['t1/c1' => $chapter], $capturedContext['chapters']);
        self::assertSame($tags, $capturedContext['tags']);
        self::assertSame($authors, $capturedContext['authors']);

        /** @var \DateTimeInterface $articlesLastModified */
        $articlesLastModified = $capturedContext['articlesLastModified'];
        self::assertSame('2025-01-01', $articlesLastModified->format('Y-m-d'));

        /** @var \DateTimeInterface $tutorialsLastModified */
        $tutorialsLastModified = $capturedContext['tutorialsLastModified'];
        self::assertSame('2025-03-01', $tutorialsLastModified->format('Y-m-d'), 'The tutorials freshness accounts for their chapters.');
    }
}

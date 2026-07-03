<?php

declare(strict_types=1);

namespace App\Tests\Responder\Publication;

use App\Domain\Publication\DTO\FeedEntry;
use App\Responder\Publication\RssResponder;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;

#[CoversClass(RssResponder::class)]
class RssResponderTest extends TestCase
{
    public function testRespondSetsAtomContentType(): void
    {
        $render = static fn (string $template, array $parameters): Response => new Response('');

        $response = new RssResponder(static fn () => null, static fn (): RedirectResponse => new RedirectResponse('/'), $render)->respond([]);

        self::assertSame('application/atom+xml; charset=utf-8', $response->headers->get('Content-Type'));
    }

    public function testRespondRendersExpectedTemplateWithEntries(): void
    {
        $renderCalled = 0;
        $render = function (string $template, array $parameters) use (&$renderCalled): Response {
            ++$renderCalled;
            self::assertSame('rss/rss.xml.twig', $template);
            self::assertArrayHasKey('entries', $parameters);
            self::assertArrayHasKey('lastModified', $parameters);

            return new Response('');
        };

        new RssResponder(static fn () => null, static fn (): RedirectResponse => new RedirectResponse('/'), $render)->respond([]);

        self::assertSame(1, $renderCalled);
    }

    public function testRespondSetsLastModifiedFromMostRecentlyUpdatedEntry(): void
    {
        $render = static fn (string $template, array $parameters): Response => new Response('');

        $mostRecent = new \DateTimeImmutable('2025-05-01 08:00:00');

        $response = new RssResponder(static fn () => null, static fn (): RedirectResponse => new RedirectResponse('/'), $render)->respond([
            self::entry(new \DateTimeImmutable('2025-01-01')),
            self::entry($mostRecent),
        ]);

        self::assertNotNull($response->getLastModified());
        self::assertSame($mostRecent->format('U'), $response->getLastModified()->format('U'));
    }

    private static function entry(\DateTimeImmutable $updated): FeedEntry
    {
        return new FeedEntry(
            title: 'Titre',
            description: null,
            routeName: 'article_show',
            routeParams: ['slug' => 'slug'],
            publishedAt: $updated,
            updated: $updated,
            authors: [],
            tags: [],
        );
    }
}

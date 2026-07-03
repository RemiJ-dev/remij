<?php

declare(strict_types=1);

namespace App\Tests\Responder\Publication;

use App\Domain\Publication\Model\Author;
use App\Domain\Tutorial\Model\Tutorial;
use App\Responder\Publication\ListByAuthorResponder;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;

#[CoversClass(ListByAuthorResponder::class)]
class ListByAuthorResponderTest extends TestCase
{
    public function testRespondRendersExpectedTemplate(): void
    {
        $author = new Author(slug: 'remij', name: 'RémiJ');

        $renderCalled = 0;
        $render = function (string $template, array $parameters) use (&$renderCalled, $author): Response {
            ++$renderCalled;
            self::assertSame('publications/list_by_author.html.twig', $template);
            self::assertArrayHasKey('publications', $parameters);
            self::assertSame($author, $parameters['author']);

            return new Response('<html>author</html>');
        };

        $response = new ListByAuthorResponder(static fn () => null, static fn (): RedirectResponse => new RedirectResponse('/'), $render)->respond($author, []);

        self::assertSame(1, $renderCalled);
        self::assertSame('<html>author</html>', $response->getContent());
        self::assertNull($response->getLastModified());
    }

    public function testRespondSetsLastModifiedFromPublications(): void
    {
        $render = static fn (string $template, array $parameters): Response => new Response('');

        $lastModified = new \DateTimeImmutable('2025-05-01 08:00:00');
        $tutorial = new Tutorial(
            slug: 'symfony-les-bases',
            title: 'Symfony : les bases',
            description: null,
            content: '',
            authors: ['remij'],
            tags: [],
            publishedAt: $lastModified,
            lastModified: $lastModified,
        );

        $response = new ListByAuthorResponder(static fn () => null, static fn (): RedirectResponse => new RedirectResponse('/'), $render)
            ->respond(new Author(slug: 'remij', name: 'RémiJ'), [$tutorial]);

        self::assertNotNull($response->getLastModified());
        self::assertSame($lastModified->format('U'), $response->getLastModified()->format('U'));
    }
}

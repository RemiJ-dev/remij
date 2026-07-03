<?php

declare(strict_types=1);

namespace App\Tests\Responder\Tutorial;

use App\Domain\Tutorial\Model\Tutorial;
use App\Responder\Tutorial\ListResponder;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;

#[CoversClass(ListResponder::class)]
class ListResponderTest extends TestCase
{
    public function testRespondRendersExpectedTemplate(): void
    {
        $renderCalled = 0;
        $render = function (string $template, array $parameters) use (&$renderCalled): Response {
            ++$renderCalled;
            self::assertSame('tutorials/list.html.twig', $template);
            self::assertArrayHasKey('tutorials', $parameters);

            return new Response('<html>list</html>');
        };

        $response = new ListResponder(static fn () => null, static fn (): RedirectResponse => new RedirectResponse('/'), $render)->respond([]);

        self::assertSame(1, $renderCalled);
        self::assertInstanceOf(Response::class, $response);
        self::assertSame('<html>list</html>', $response->getContent());
        self::assertNull($response->getLastModified());
    }

    public function testRespondSetsLastModifiedFromTutorials(): void
    {
        $render = static fn (string $template, array $parameters): Response => new Response('');

        $lastModified = new \DateTimeImmutable('2025-03-01 09:00:00');
        $tutorial = new Tutorial(
            slug: 'symfony-les-bases',
            title: 'Symfony : les bases',
            description: null,
            content: '',
            authors: [],
            tags: [],
            publishedAt: $lastModified,
            lastModified: $lastModified,
        );

        $response = new ListResponder(static fn () => null, static fn (): RedirectResponse => new RedirectResponse('/'), $render)->respond(['symfony-les-bases' => $tutorial]);

        self::assertNotNull($response->getLastModified());
        self::assertSame($lastModified->format('U'), $response->getLastModified()->format('U'));
    }
}

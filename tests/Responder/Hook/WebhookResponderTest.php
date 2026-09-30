<?php

declare(strict_types=1);

namespace App\Tests\Responder\Hook;

use App\Domain\Planka\DTO\NumberingResult;
use App\Responder\Hook\WebhookResponder;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\RedirectResponse;

#[CoversClass(WebhookResponder::class)]
class WebhookResponderTest extends TestCase
{
    public function testResultIsReturnedAsJsonWithoutNullFields(): void
    {
        $responder = new WebhookResponder(static fn () => null, static fn (): RedirectResponse => new RedirectResponse('/'));

        $response = $responder(NumberingResult::numbered('100', '#1 · Titre', 'feat/1-titre'));

        self::assertSame(200, $response->getStatusCode());
        self::assertSame('application/json', $response->headers->get('Content-Type'));
        self::assertSame(
            ['status' => 'numbered', 'cardId' => '100', 'title' => '#1 · Titre', 'branch' => 'feat/1-titre'],
            json_decode((string) $response->getContent(), true),
        );
    }

    public function testIgnoredResultCarriesItsReason(): void
    {
        $responder = new WebhookResponder(static fn () => null, static fn (): RedirectResponse => new RedirectResponse('/'));

        $response = $responder(NumberingResult::ignored(null, 'event "boardUpdate" not handled here'));

        self::assertSame(
            ['status' => 'ignored', 'reason' => 'event "boardUpdate" not handled here'],
            json_decode((string) $response->getContent(), true),
        );
    }
}

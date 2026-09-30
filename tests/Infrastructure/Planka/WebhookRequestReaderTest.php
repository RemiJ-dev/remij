<?php

declare(strict_types=1);

namespace App\Tests\Infrastructure\Planka;

use App\Domain\Planka\DTO\WebhookEvent;
use App\Infrastructure\Planka\WebhookRequestReader;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;

#[CoversClass(WebhookRequestReader::class)]
class WebhookRequestReaderTest extends TestCase
{
    private const string TOKEN = 'secret-token';

    public function testCardCreateEventCarriesTheCardId(): void
    {
        $event = new WebhookRequestReader(self::TOKEN)->read($this->request(['event' => 'cardCreate', 'data' => ['item' => ['id' => '123']]]));

        self::assertSame(WebhookEvent::CARD_CREATE, $event->name);
        self::assertSame('123', $event->cardId);
    }

    public function testCardLabelEventCarriesTheCardIdOfTheCardLabel(): void
    {
        $event = new WebhookRequestReader(self::TOKEN)->read($this->request(['event' => 'cardLabelCreate', 'data' => ['item' => ['id' => '999', 'cardId' => '123', 'labelId' => '7']]]));

        self::assertSame('123', $event->cardId);
    }

    public function testOtherEventsHaveNoCardId(): void
    {
        $event = new WebhookRequestReader(self::TOKEN)->read($this->request(['event' => 'boardUpdate', 'data' => ['item' => ['id' => '1']]]));

        self::assertSame('boardUpdate', $event->name);
        self::assertNull($event->cardId);
    }

    public function testWrongTokenIsRejected(): void
    {
        $this->expectException(UnauthorizedHttpException::class);

        new WebhookRequestReader(self::TOKEN)->read($this->request(['event' => 'cardCreate'], 'wrong'));
    }

    public function testMissingTokenIsRejected(): void
    {
        $request = Request::create('/planka/create', 'POST', content: '{"event":"cardCreate"}');

        $this->expectException(UnauthorizedHttpException::class);

        new WebhookRequestReader(self::TOKEN)->read($request);
    }

    public function testUnconfiguredTokenRejectsEverything(): void
    {
        $request = Request::create('/planka/create', 'POST', server: ['HTTP_AUTHORIZATION' => 'Bearer '], content: '{"event":"cardCreate"}');

        $this->expectException(AccessDeniedHttpException::class);

        new WebhookRequestReader('')->read($request);
    }

    public function testInvalidJsonIsABadRequest(): void
    {
        $request = Request::create('/planka/create', 'POST', server: ['HTTP_AUTHORIZATION' => 'Bearer ' . self::TOKEN], content: 'not json');

        $this->expectException(BadRequestHttpException::class);

        new WebhookRequestReader(self::TOKEN)->read($request);
    }

    public function testNonNumericCardIdIsRejected(): void
    {
        $this->expectException(BadRequestHttpException::class);

        new WebhookRequestReader(self::TOKEN)->read($this->request(['event' => 'cardCreate', 'data' => ['item' => ['id' => '1/../../users/me']]]));
    }

    /**
     * @param array<string, mixed> $payload
     */
    private function request(array $payload, string $token = self::TOKEN): Request
    {
        return Request::create(
            '/planka/create',
            'POST',
            server: ['HTTP_AUTHORIZATION' => 'Bearer ' . $token, 'CONTENT_TYPE' => 'application/json'],
            content: json_encode($payload, \JSON_THROW_ON_ERROR),
        );
    }
}

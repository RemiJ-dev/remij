<?php

declare(strict_types=1);

namespace App\Tests\Controller\Trello;

use App\Controller\Trello\WebhookAction;
use App\Trello\Connection;
use App\Trello\ConnectionRepository;
use PHPUnit\Framework\Attributes\CoversClass;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

#[CoversClass(WebhookAction::class)]
class WebhookActionTest extends WebTestCase
{
    private const string BOARD_ID = 'board123';
    private const string CALLBACK_URL = 'http://localhost/trello/webhook';
    private const string APP_SECRET = 'test-secret';

    public function testHeadReturns200(): void
    {
        $client = static::createClient();
        $client->request('HEAD', '/trello/webhook');

        self::assertResponseIsSuccessful();
    }

    public function testPostWithoutSignatureReturns401(): void
    {
        $client = static::createClient();
        $client->request('POST', '/trello/webhook', [], [], [], '{}');

        self::assertResponseStatusCodeSame(401);
    }

    public function testPostWithInvalidSignatureReturns401(): void
    {
        $client = static::createClient();
        $client->request('POST', '/trello/webhook', [], [], [
            'HTTP_X_TRELLO_WEBHOOK' => 'invalidsignature',
        ], '{"model":{"id":"board123"},"action":{"type":"createCard"}}');

        self::assertResponseStatusCodeSame(401);
    }

    /**
     * @throws \JsonException
     */
    public function testPostWithValidSignatureAndKnownBoardReturns200(): void
    {
        $client = static::createClient();

        $body = json_encode([
            'model' => ['id' => self::BOARD_ID],
            'action' => [
                'type' => 'createCard',
                'data' => [
                    'board' => ['id' => self::BOARD_ID, 'name' => 'Test Board'],
                    'list' => ['name' => 'To Do'],
                    'card' => ['id' => 'card1', 'name' => 'My Card'],
                ],
                'memberCreator' => ['fullName' => 'Alice'],
            ],
        ], \JSON_THROW_ON_ERROR);

        $signature = base64_encode(hash_hmac('sha1', $body . self::CALLBACK_URL, self::APP_SECRET, true));

        $connection = new Connection(
            boardId: self::BOARD_ID,
            boardName: 'Test Board',
            trelloWebhookId: 'webhook1',
            mattermostChannel: 'general',
            createdAt: new \DateTimeImmutable(),
            updatedAt: new \DateTimeImmutable(),
        );

        $container = static::getContainer();
        /** @var ConnectionRepository $repository */
        $repository = $container->get(ConnectionRepository::class);
        $repository->save($connection);

        try {
            $client->request('POST', '/trello/webhook', [], [], [
                'HTTP_X_TRELLO_WEBHOOK' => $signature,
                'CONTENT_TYPE' => 'application/json',
            ], $body);

            self::assertResponseIsSuccessful();
        } finally {
            $repository->delete(self::BOARD_ID);
        }
    }

    /**
     * @throws \JsonException
     */
    public function testPostWithValidSignatureAndUnknownBoardReturns404(): void
    {
        $client = static::createClient();

        $body = json_encode([
            'model' => ['id' => 'unknown-board'],
            'action' => ['type' => 'createCard'],
        ], \JSON_THROW_ON_ERROR);

        $signature = base64_encode(hash_hmac('sha1', $body . self::CALLBACK_URL, self::APP_SECRET, true));

        $client->request('POST', '/trello/webhook', [], [], [
            'HTTP_X_TRELLO_WEBHOOK' => $signature,
            'CONTENT_TYPE' => 'application/json',
        ], $body);

        self::assertResponseStatusCodeSame(404);
    }
}

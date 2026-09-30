<?php

declare(strict_types=1);

namespace App\Tests\Action;

use PHPUnit\Framework\Attributes\DataProvider;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

/**
 * Webhooks Planka : seules les branches qui n'appellent pas l'API Planka sont testées ici,
 * le traitement des cartes est couvert par les tests unitaires de CardNumberer et PlankaClient.
 */
class HookActionsTest extends WebTestCase
{
    /**
     * @return iterable<string, array{string}>
     */
    public static function hookPathProvider(): iterable
    {
        yield 'create' => ['/planka/create'];
        yield 'labels' => ['/planka/labels'];
    }

    #[DataProvider('hookPathProvider')]
    public function testRequestWithoutTokenIsUnauthorized(string $path): void
    {
        $client = static::createClient();
        $client->request('POST', $path, content: '{"event":"cardCreate","data":{"item":{"id":"1"}}}');

        self::assertResponseStatusCodeSame(401);
    }

    #[DataProvider('hookPathProvider')]
    public function testUnhandledEventIsIgnored(string $path): void
    {
        $client = static::createClient();
        $client->request('POST', $path, server: $this->authorization(), content: '{"event":"boardUpdate","data":{"item":{"id":"1"}}}');

        self::assertResponseIsSuccessful();
        self::assertJsonStringEqualsJsonString(
            '{"status":"ignored","reason":"event \"boardUpdate\" not handled here"}',
            (string) $client->getResponse()->getContent(),
        );
    }

    #[DataProvider('hookPathProvider')]
    public function testGetIsNotServed(string $path): void
    {
        $client = static::createClient();
        $client->request('GET', $path);

        // La route est POST uniquement : un GET retombe sur le catch-all des pages, sans page correspondante.
        self::assertResponseStatusCodeSame(404);
    }

    public function testInvalidPayloadIsABadRequest(): void
    {
        $client = static::createClient();
        $client->request('POST', '/planka/create', server: $this->authorization(), content: 'not json');

        self::assertResponseStatusCodeSame(400);
    }

    /**
     * @return array<string, string>
     */
    private function authorization(): array
    {
        return ['HTTP_AUTHORIZATION' => 'Bearer test-webhook-token', 'CONTENT_TYPE' => 'application/json'];
    }
}

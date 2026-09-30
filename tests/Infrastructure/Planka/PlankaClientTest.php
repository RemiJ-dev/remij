<?php

declare(strict_types=1);

namespace App\Tests\Infrastructure\Planka;

use App\Domain\Planka\DTO\BranchField;
use App\Infrastructure\Planka\PlankaClient;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpClient\MockHttpClient;
use Symfony\Component\HttpClient\Response\JsonMockResponse;
use Symfony\Component\HttpClient\Response\MockResponse;
use Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface;
use Symfony\Contracts\HttpClient\ResponseInterface;

#[CoversClass(PlankaClient::class)]
class PlankaClientTest extends TestCase
{
    private const string BASE_URI = 'https://planka.test';

    public function testFindCardMapsLabelsAndCustomFieldValues(): void
    {
        $client = $this->client([
            'GET /api/cards/100' => new JsonMockResponse([
                'item' => ['id' => '100', 'name' => 'Titre', 'boardId' => 'b1', 'createdAt' => '2026-09-30T10:00:00Z'],
                'included' => [
                    'cardLabels' => [['cardId' => '100', 'labelId' => 'l1']],
                    'customFieldValues' => [['cardId' => '100', 'customFieldGroupId' => 'g1', 'customFieldId' => 'f1', 'content' => 'feat/1-titre']],
                ],
            ]),
        ]);

        $card = $client->findCard('100');

        self::assertNotNull($card);
        self::assertSame('Titre', $card->name);
        self::assertSame('b1', $card->boardId);
        self::assertSame(['l1'], $card->labelIds);
        self::assertSame('feat/1-titre', $card->customFieldValue(new BranchField('g1', 'f1')));
    }

    public function testInaccessibleResourcesAreNull(): void
    {
        $client = $this->client([
            'GET /api/cards/404' => new JsonMockResponse(['code' => 'E_NOT_FOUND'], ['http_code' => 404]),
            'GET /api/boards/403' => new JsonMockResponse(['code' => 'E_FORBIDDEN'], ['http_code' => 403]),
        ]);

        self::assertNull($client->findCard('404'));
        self::assertNull($client->findBoard('403'));
    }

    public function testServerErrorsAreNotSwallowed(): void
    {
        $client = $this->client(['GET /api/cards/500' => new MockResponse('', ['http_code' => 500])]);

        $this->expectException(ServerExceptionInterface::class);

        $client->findCard('500');
    }

    public function testFindBoardResolvesTheBranchFieldThroughTheBoardGroup(): void
    {
        $client = $this->client([
            'GET /api/boards/b1' => new JsonMockResponse([
                'item' => ['id' => 'b1', 'projectId' => 'p1'],
                'included' => [
                    'labels' => [['id' => 'l1', 'name' => 'Bug'], ['id' => 'l2', 'name' => null]],
                    'cards' => [['id' => '100', 'name' => '#3 · Titre', 'createdAt' => '2026-01-01T00:00:00Z']],
                    'cardLabels' => [['cardId' => '100', 'labelId' => 'l1']],
                    'customFieldGroups' => [
                        ['id' => 'card-group', 'baseCustomFieldGroupId' => 'base-github', 'boardId' => null, 'cardId' => '100'],
                        ['id' => 'board-group', 'baseCustomFieldGroupId' => 'base-github', 'boardId' => 'b1', 'cardId' => null],
                    ],
                ],
            ]),
            'GET /api/projects/p1' => new JsonMockResponse([
                'item' => ['id' => 'p1'],
                'included' => ['customFields' => [
                    ['id' => 'f-pr', 'name' => 'PR', 'baseCustomFieldGroupId' => 'base-github'],
                    ['id' => 'f-branch', 'name' => 'branche', 'baseCustomFieldGroupId' => 'base-github'],
                ]],
            ]),
        ]);

        $board = $client->findBoard('b1');

        self::assertNotNull($board);
        self::assertSame('p1', $board->projectId);
        self::assertEquals(new BranchField('board-group', 'f-branch'), $board->branchField);
        self::assertSame(['Bug'], $board->labelNamesOf(['l1', 'unknown']));
        self::assertSame(['l1'], $board->cards[0]->labelIds);
        self::assertSame(3, $board->highestNumber());
    }

    public function testFindBoardWithoutBranchFieldOnTheBoard(): void
    {
        $client = $this->client([
            'GET /api/boards/b1' => new JsonMockResponse(['item' => ['id' => 'b1', 'projectId' => 'p1'], 'included' => []]),
            'GET /api/projects/p1' => new JsonMockResponse(['item' => ['id' => 'p1'], 'included' => ['customFields' => [
                ['id' => 'f-branch', 'name' => 'Branche', 'baseCustomFieldGroupId' => 'base-github'],
            ]]]),
        ]);

        self::assertNull($client->findBoard('b1')?->branchField);
    }

    public function testWritesUseTheExpectedEndpoints(): void
    {
        $requests = [];
        $http = new MockHttpClient(static function (string $method, string $url, array $options) use (&$requests): ResponseInterface {
            $requests[] = [$method, $url, $options['body'] ?? null];

            return new JsonMockResponse(['item' => []]);
        }, self::BASE_URI);

        $client = new PlankaClient($http, 'Branche');
        $client->renameCard('100', '#1 · Titre');
        $client->setCustomFieldValue('100', new BranchField('g1', 'f1'), 'feat/1-titre');

        self::assertSame('PATCH', $requests[0][0]);
        self::assertSame(self::BASE_URI . '/api/cards/100', $requests[0][1]);
        self::assertSame(['name' => '#1 · Titre'], json_decode(self::body($requests[0][2]), true));
        self::assertSame(self::BASE_URI . '/api/cards/100/custom-field-values/customFieldGroupId:g1:customFieldId:f1', $requests[1][1]);
        self::assertSame(['content' => 'feat/1-titre'], json_decode(self::body($requests[1][2]), true));
    }

    /**
     * @param array<string, ResponseInterface> $routes réponses indexées par « MÉTHODE /chemin »
     */
    private function client(array $routes): PlankaClient
    {
        $http = new MockHttpClient(static function (string $method, string $url) use ($routes): ResponseInterface {
            $path = (string) parse_url($url, \PHP_URL_PATH);

            return $routes[$method . ' ' . $path] ?? throw new \LogicException(\sprintf('Unexpected request %s %s', $method, $url));
        }, self::BASE_URI);

        return new PlankaClient($http, 'Branche');
    }

    private static function body(mixed $body): string
    {
        self::assertIsString($body);

        return $body;
    }
}

<?php

declare(strict_types=1);

namespace App\Trello;

use Symfony\Contracts\HttpClient\HttpClientInterface;

final readonly class TrelloApiClient
{
    private const string API_BASE = 'https://api.trello.com/1';

    public function __construct(
        private HttpClientInterface $httpClient,
        private string $apiKey,
        private string $apiToken,
    ) {
    }

    public function getBoardName(string $boardId): string
    {
        $response = $this->httpClient->request('GET', self::API_BASE . '/boards/' . $boardId, [
            'query' => [
                'key' => $this->apiKey,
                'token' => $this->apiToken,
                'fields' => 'name',
            ],
        ]);

        /** @var array{name: string} $data */
        $data = $response->toArray();

        return $data['name'];
    }

    public function createWebhook(string $boardId, string $callbackUrl): string
    {
        $response = $this->httpClient->request('POST', self::API_BASE . '/webhooks', [
            'query' => [
                'key' => $this->apiKey,
                'token' => $this->apiToken,
            ],
            'json' => [
                'callbackURL' => $callbackUrl,
                'idModel' => $boardId,
                'description' => 'RémiJ → Mattermost',
            ],
        ]);

        /** @var array{id: string} $data */
        $data = $response->toArray();

        return $data['id'];
    }

    public function deleteWebhook(string $webhookId): void
    {
        $this->httpClient->request('DELETE', self::API_BASE . '/webhooks/' . $webhookId, [
            'query' => [
                'key' => $this->apiKey,
                'token' => $this->apiToken,
            ],
        ])->getStatusCode();
    }
}

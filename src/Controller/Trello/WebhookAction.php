<?php

declare(strict_types=1);

namespace App\Controller\Trello;

use App\Message\TrelloEvent;
use App\Trello\ConnectionRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Routing\Attribute\Route;

#[Route(name: 'trello_')]
final readonly class WebhookAction
{
    public function __construct(
        private ConnectionRepository $repository,
        private MessageBusInterface $bus,
        private string $trelloAppSecret,
        private string $webhookCallbackUrl,
    ) {
    }

    #[Route('/trello/webhook', name: 'webhook', methods: ['HEAD', 'POST'])]
    public function __invoke(Request $request): Response
    {
        if ($request->isMethod('HEAD')) {
            return new Response();
        }

        $body = $request->getContent();

        if (!$this->isSignatureValid($request, $body)) {
            return new Response('Invalid signature', Response::HTTP_UNAUTHORIZED);
        }

        try {
            /** @var array<string, mixed> $payload */
            $payload = json_decode($body, true, 512, \JSON_THROW_ON_ERROR);
        } catch (\JsonException) {
            return new Response('Invalid JSON', Response::HTTP_BAD_REQUEST);
        }

        /** @var array<string, mixed> $model */
        $model = \is_array($payload['model'] ?? null) ? $payload['model'] : [];
        $boardId = \is_string($model['id'] ?? null) ? $model['id'] : '';
        $connection = $this->repository->find($boardId);

        if (null === $connection) {
            return new Response('Unknown board', Response::HTTP_NOT_FOUND);
        }

        $this->bus->dispatch(new TrelloEvent($payload, $connection));

        return new Response();
    }

    private function isSignatureValid(Request $request, string $body): bool
    {
        $signature = $request->headers->get('X-Trello-Webhook');
        if (null === $signature) {
            return false;
        }

        $expected = base64_encode(hash_hmac('sha1', $body . $this->webhookCallbackUrl, $this->trelloAppSecret, true));

        return hash_equals($expected, $signature);
    }
}

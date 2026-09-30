<?php

declare(strict_types=1);

namespace App\Infrastructure\Planka;

use App\Domain\Planka\DTO\WebhookEvent;
use Symfony\Component\DependencyInjection\Attribute\Autowire;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;

/**
 * Authentifie une requête de webhook Planka et en extrait l'événement.
 *
 * Planka envoie « Authorization: Bearer <accessToken> », le jeton saisi dans la configuration du webhook.
 * Sans jeton configuré côté hooks, toute requête est refusée.
 */
readonly class WebhookRequestReader
{
    public function __construct(
        #[Autowire(env: 'PLANKA_WEBHOOK_TOKEN')]
        private string $token,
    ) {
    }

    public function read(Request $request): WebhookEvent
    {
        if ('' === $this->token) {
            throw new AccessDeniedHttpException('The Planka webhook token is not configured.');
        }

        if (!hash_equals('Bearer ' . $this->token, $request->headers->get('Authorization', ''))) {
            throw new UnauthorizedHttpException('Bearer', 'Invalid webhook token.');
        }

        try {
            $payload = $request->toArray();
        } catch (\Throwable $exception) {
            throw new BadRequestHttpException('The webhook payload is not valid JSON.', $exception);
        }

        $event = $payload['event'] ?? null;
        if (!\is_string($event) || '' === $event) {
            throw new BadRequestHttpException('The webhook payload has no event.');
        }

        $data = $payload['data'] ?? null;
        $item = \is_array($data) ? ($data['item'] ?? null) : null;
        $item = \is_array($item) ? $item : [];

        // Une carte porte son id dans « id », une étiquette de carte dans « cardId ».
        $cardId = WebhookEvent::CARD_CREATE === $event ? ($item['id'] ?? null) : ($item['cardId'] ?? null);

        // L'id est concaténé dans des chemins d'API : on n'accepte que des chiffres.
        if (null !== $cardId && (!\is_string($cardId) || 1 !== preg_match('/^\d+$/', $cardId))) {
            throw new BadRequestHttpException('The webhook payload has an invalid card id.');
        }

        return new WebhookEvent($event, $cardId);
    }
}

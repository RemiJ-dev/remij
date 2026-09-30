<?php

declare(strict_types=1);

namespace App\Action\Hook;

use App\Domain\Planka\DTO\NumberingResult;
use App\Domain\Planka\DTO\WebhookEvent;
use App\Domain\Planka\Service\CardNumberer;
use App\Infrastructure\Planka\WebhookRequestReader;
use App\Responder\Hook\WebhookResponder;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Contracts\HttpClient\Exception\ExceptionInterface;

/**
 * Webhook Planka « cardCreate » : numérote la carte et remplit son champ « Branche ».
 * Route dynamique, servie par PHP-FPM sur hooks.remij.dev : absente du build statique Stenope.
 */
readonly class PlankaCreateAction
{
    /**
     * @throws ExceptionInterface
     */
    #[Route('/planka/create', name: 'hook_planka_create', options: ['stenope' => ['ignore' => true]], methods: ['POST'])]
    public function __invoke(
        Request $request,
        WebhookRequestReader $reader,
        CardNumberer $numberer,
        WebhookResponder $responder,
    ): JsonResponse {
        $event = $reader->read($request);

        if (WebhookEvent::CARD_CREATE !== $event->name || null === $event->cardId) {
            return $responder(NumberingResult::ignored($event->cardId, \sprintf('event "%s" not handled here', $event->name)));
        }

        return $responder($numberer->numberNewCard($event->cardId));
    }
}

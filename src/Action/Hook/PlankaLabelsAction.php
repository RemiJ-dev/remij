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
 * Webhook Planka « cardLabelCreate » / « cardLabelDelete » : recalcule le préfixe (feat/fix) du champ « Branche ».
 */
readonly class PlankaLabelsAction
{
    /**
     * @throws ExceptionInterface
     */
    #[Route('/planka/labels', name: 'hook_planka_labels', options: ['stenope' => ['ignore' => true]], methods: ['POST'])]
    public function __invoke(
        Request $request,
        WebhookRequestReader $reader,
        CardNumberer $numberer,
        WebhookResponder $responder,
    ): JsonResponse {
        $event = $reader->read($request);

        if (!\in_array($event->name, [WebhookEvent::CARD_LABEL_CREATE, WebhookEvent::CARD_LABEL_DELETE], true) || null === $event->cardId) {
            return $responder(NumberingResult::ignored($event->cardId, \sprintf('event "%s" not handled here', $event->name)));
        }

        return $responder($numberer->refreshBranchPrefix($event->cardId));
    }
}

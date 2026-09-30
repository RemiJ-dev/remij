<?php

declare(strict_types=1);

namespace App\Responder\Hook;

use App\Domain\Planka\DTO\NumberingResult;
use App\Responder\AbstractResponder;
use Symfony\Component\HttpFoundation\JsonResponse;

class WebhookResponder extends AbstractResponder
{
    public function __invoke(NumberingResult $result): JsonResponse
    {
        return new JsonResponse($result->toArray());
    }
}

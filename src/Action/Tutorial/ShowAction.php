<?php

declare(strict_types=1);

namespace App\Action\Tutorial;

use App\Domain\Tutorial\Model\Tutorial;
use App\Domain\Tutorial\Repository\TutorialRepository;
use App\Responder\Tutorial\ShowResponder;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

readonly class ShowAction
{
    /**
     * @throws SyntaxError
     * @throws RuntimeError
     * @throws LoaderError
     */
    #[Route('/tutoriels/{slug:tutorial}', name: 'tutorial_show')]
    public function __invoke(
        Tutorial $tutorial,
        TutorialRepository $repository,
        ShowResponder $responder,
    ): Response {
        return $responder->respond($tutorial, $repository->findChapters($tutorial));
    }
}

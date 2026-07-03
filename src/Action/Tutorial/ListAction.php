<?php

declare(strict_types=1);

namespace App\Action\Tutorial;

use App\Domain\Tutorial\Repository\TutorialRepository;
use App\Responder\Tutorial\ListResponder;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

readonly class ListAction
{
    /**
     * @throws RuntimeError
     * @throws SyntaxError
     * @throws LoaderError
     */
    #[Route('/tutoriels/', name: 'tutorial_list')]
    public function __invoke(
        TutorialRepository $repository,
        ListResponder $responder,
    ): Response {
        return $responder->respond($repository->findPublished());
    }
}

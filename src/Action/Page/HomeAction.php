<?php

declare(strict_types=1);

namespace App\Action\Page;

use App\Responder\Page\HomeResponder;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

readonly class HomeAction
{
    /**
     * @throws RuntimeError
     * @throws SyntaxError
     * @throws LoaderError
     */
    #[Route('/', name: 'page_home')]
    public function __invoke(
        HomeResponder $responder,
    ): Response {
        return ($responder)();
    }
}

<?php

declare(strict_types=1);

namespace App\Controller\Page;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

readonly class HomeAction
{
    public function __construct(private Environment $twig)
    {
    }

    /**
     * @throws RuntimeError
     * @throws SyntaxError
     * @throws LoaderError
     */
    #[Route('/', name: 'page_home')]
    public function __invoke(): Response
    {
        return new Response($this->twig->render('pages/home.html.twig'));
    }
}

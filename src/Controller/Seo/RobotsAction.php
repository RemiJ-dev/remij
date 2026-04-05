<?php

declare(strict_types=1);

namespace App\Controller\Seo;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

readonly class RobotsAction
{
    public function __construct(private Environment $twig)
    {
    }

    /**
     * @throws RuntimeError
     * @throws SyntaxError
     * @throws LoaderError
     */
    #[Route('/robots.txt', name: 'seo_robots')]
    public function __invoke(): Response
    {
        $response = new Response($this->twig->render('seo/robots.txt.twig'));
        $response->headers->set('Content-Type', 'text/plain');

        return $response;
    }
}

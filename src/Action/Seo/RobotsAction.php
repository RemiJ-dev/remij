<?php

declare(strict_types=1);

namespace App\Action\Seo;

use App\Responder\Seo\RobotsResponder;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

readonly class RobotsAction
{
    /**
     * @throws RuntimeError
     * @throws SyntaxError
     * @throws LoaderError
     */
    #[Route('/robots.txt', name: 'seo_robots')]
    public function __invoke(RobotsResponder $responder): Response
    {
        return ($responder)();
    }
}

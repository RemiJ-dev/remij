<?php

declare(strict_types=1);

namespace App\Responder\Seo;

use App\Responder\AbstractTwigResponder;
use Symfony\Component\HttpFoundation\Response;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

class RobotsResponder extends AbstractTwigResponder
{
    /**
     * @throws RuntimeError
     * @throws SyntaxError
     * @throws LoaderError
     */
    public function __invoke(): Response
    {
        $response = $this->render('seo/robots.txt.twig');
        $response->headers->set('Content-Type', 'text/plain');

        return $response;
    }
}

<?php

declare(strict_types=1);

namespace App\Responder\Page;

use App\Responder\AbstractTwigResponder;
use Symfony\Component\HttpFoundation\Response;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

class HomeResponder extends AbstractTwigResponder
{
    /**
     * @throws RuntimeError
     * @throws SyntaxError
     * @throws LoaderError
     */
    public function __invoke(): Response
    {
        return $this->render('pages/home.html.twig');
    }
}

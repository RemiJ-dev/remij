<?php

declare(strict_types=1);

namespace App\Responder;

use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

abstract class AbstractTwigResponder
{
    public function __construct(protected readonly Environment $twig)
    {
    }

    /**
     * @param array<string, mixed> $parameters
     *
     * @throws RuntimeError
     * @throws SyntaxError
     * @throws LoaderError
     */
    protected function render(string $template, array $parameters = []): Response
    {
        return new Response($this->twig->render($template, $parameters));
    }
}

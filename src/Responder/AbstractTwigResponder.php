<?php

declare(strict_types=1);

namespace App\Responder;

use Symfony\Bundle\FrameworkBundle\Controller\ControllerHelper;
use Symfony\Component\DependencyInjection\Attribute\AutowireMethodOf;
use Symfony\Component\HttpFoundation\Response;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

abstract class AbstractTwigResponder
{
    /**
     * @param \Closure(string, array<string, mixed>, Response|null=): Response $render
     */
    public function __construct(
        #[AutowireMethodOf(ControllerHelper::class)]
        private readonly \Closure $render,
    ) {
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
        return ($this->render)($template, $parameters);
    }
}

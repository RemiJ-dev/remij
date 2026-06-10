<?php

declare(strict_types=1);

namespace App\Responder;

use Symfony\Bundle\FrameworkBundle\Controller\ControllerHelper;
use Symfony\Component\DependencyInjection\Attribute\AutowireMethodOf;
use Symfony\Component\HttpFoundation\Response;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

abstract class AbstractTwigResponder extends AbstractResponder
{
    /**
     * @param \Closure(string, array<string, mixed>, Response|null=): Response $render
     */
    public function __construct(
        #[AutowireMethodOf(ControllerHelper::class)]
        protected \Closure $addFlash,
        #[AutowireMethodOf(ControllerHelper::class)]
        protected \Closure $redirectToRoute,
        #[AutowireMethodOf(ControllerHelper::class)]
        protected readonly \Closure $render,
    ) {
        parent::__construct($addFlash, $redirectToRoute);
    }

    /**
     * @param array<string, mixed> $parameters
     *
     * @throws RuntimeError
     * @throws SyntaxError
     * @throws LoaderError
     */
    protected function render(string $template, array $parameters = [], int $status = Response::HTTP_OK): Response
    {
        return ($this->render)($template, $parameters, new Response(status: $status));
    }
}

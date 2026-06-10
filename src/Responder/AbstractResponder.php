<?php

declare(strict_types=1);

namespace App\Responder;

use Symfony\Bundle\FrameworkBundle\Controller\ControllerHelper;
use Symfony\Component\DependencyInjection\Attribute\AutowireMethodOf;
use Symfony\Component\HttpFoundation\RedirectResponse;

abstract class AbstractResponder
{
    /**
     * @param \Closure(string, array<string, mixed>=, int=): RedirectResponse $redirectToRoute
     */
    public function __construct(
        #[AutowireMethodOf(ControllerHelper::class)]
        protected \Closure $addFlash,
        #[AutowireMethodOf(ControllerHelper::class)]
        protected \Closure $redirectToRoute,
    ) {
    }
}

<?php

declare(strict_types=1);

namespace App\Twig;

use App\Menu\MenuBuilder;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class MenuExtension extends AbstractExtension
{
    public function __construct(private MenuBuilder $menuBuilder)
    {
    }

    public function getFunctions(): array
    {
        return [
            new TwigFunction('breadcrumb', $this->breadcrumb(...)),
        ];
    }

    /** @return array<int, array<string, mixed>> */
    public function breadcrumb(): array
    {
        return $this->menuBuilder->breadcrumb();
    }
}

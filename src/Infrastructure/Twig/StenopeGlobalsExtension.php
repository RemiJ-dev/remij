<?php

declare(strict_types=1);

namespace App\Infrastructure\Twig;

use Twig\Extension\AbstractExtension;
use Twig\Extension\GlobalsInterface;

/**
 * Pre-registers Stenope's "canonical" and "root" Twig globals with empty defaults.
 *
 * In FrankenPHP worker mode, the Twig Environment persists across requests. Stenope's
 * Informator listener calls addGlobal() on each request, but Twig throws a LogicException
 * if the global was never registered before the extension set was initialized. By declaring
 * these globals here (during Twig boot), Informator can safely update them on each request.
 */
class StenopeGlobalsExtension extends AbstractExtension implements GlobalsInterface
{
    public function getGlobals(): array
    {
        return [
            'canonical' => '',
            'root' => '',
        ];
    }
}

<?php

declare(strict_types=1);

namespace App\Responder\Tutorial;

use App\Domain\Tutorial\Model\Tutorial;
use App\Responder\AbstractTwigResponder;
use Symfony\Component\HttpFoundation\Response;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

class ListResponder extends AbstractTwigResponder
{
    /**
     * @param array<string, Tutorial> $tutorials
     *
     * @throws RuntimeError
     * @throws SyntaxError
     * @throws LoaderError
     */
    public function __invoke(array $tutorials): Response
    {
        return $this->render('tutorials/list.html.twig', [
            'tutorials' => $tutorials,
        ])->setLastModified($this->getLastModified($tutorials));
    }
}

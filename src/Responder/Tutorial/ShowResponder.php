<?php

declare(strict_types=1);

namespace App\Responder\Tutorial;

use App\Domain\Tutorial\Model\Chapter;
use App\Domain\Tutorial\Model\Tutorial;
use App\Responder\AbstractTwigResponder;
use Symfony\Component\HttpFoundation\Response;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

class ShowResponder extends AbstractTwigResponder
{
    /**
     * The summary also teases unpublished chapters, so their updates
     * are part of the page freshness.
     *
     * @param array<string, Chapter> $chapters All chapters, ordered by position
     *
     * @throws RuntimeError
     * @throws SyntaxError
     * @throws LoaderError
     */
    public function respond(Tutorial $tutorial, array $chapters): Response
    {
        return $this->render('tutorials/show.html.twig', [
            'tutorial' => $tutorial,
            'chapters' => $chapters,
        ])->setLastModified($this->getLastModified([$tutorial, ...array_values($chapters)]));
    }
}

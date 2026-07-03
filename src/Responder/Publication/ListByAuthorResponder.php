<?php

declare(strict_types=1);

namespace App\Responder\Publication;

use App\Domain\Publication\Model\Author;
use App\Domain\Publication\Model\PublicationInterface;
use App\Responder\AbstractTwigResponder;
use Symfony\Component\HttpFoundation\Response;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

class ListByAuthorResponder extends AbstractTwigResponder
{
    /**
     * @param list<PublicationInterface> $publications
     *
     * @throws RuntimeError
     * @throws SyntaxError
     * @throws LoaderError
     */
    public function respond(Author $author, array $publications): Response
    {
        return $this->render('publications/list_by_author.html.twig', [
            'publications' => $publications,
            'author' => $author,
        ])->setLastModified($this->getLastModified($publications));
    }
}

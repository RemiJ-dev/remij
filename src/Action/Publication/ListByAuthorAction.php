<?php

declare(strict_types=1);

namespace App\Action\Publication;

use App\Domain\Publication\Model\Author;
use App\Domain\Publication\Repository\PublicationRepository;
use App\Responder\Publication\ListByAuthorResponder;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

readonly class ListByAuthorAction
{
    /**
     * @throws RuntimeError
     * @throws SyntaxError
     * @throws LoaderError
     */
    #[Route('/auteur/{slug:author}', name: 'publication_list_by_author')]
    public function __invoke(
        Author $author,
        PublicationRepository $repository,
        ListByAuthorResponder $responder,
    ): Response {
        $publications = $repository->findByAuthor($author);

        return $responder->respond($author, $publications);
    }
}

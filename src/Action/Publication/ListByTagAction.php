<?php

declare(strict_types=1);

namespace App\Action\Publication;

use App\Domain\Publication\Repository\PublicationRepository;
use App\Responder\Publication\ListByTagResponder;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

readonly class ListByTagAction
{
    public function __construct(
        private PublicationRepository $repository,
        private ListByTagResponder $responder,
    ) {
    }

    /**
     * @throws RuntimeError
     * @throws SyntaxError
     * @throws LoaderError
     */
    #[Route('/tag/{tag:tag}', name: 'publication_list_by_tag')]
    public function __invoke(string $tag): Response
    {
        $publications = $this->repository->findByTag($tag);

        return ($this->responder)($tag, $publications);
    }
}

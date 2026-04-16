<?php

declare(strict_types=1);

namespace App\Action\Article;

use App\Domain\Article\Model\Author;
use App\Domain\Article\Repository\ArticleRepository;
use App\Responder\Article\ListByAuthorResponder;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

readonly class ListByAuthorAction
{
    public function __construct(
        private ArticleRepository $repository,
        private ListByAuthorResponder $responder,
    ) {
    }

    /**
     * @throws RuntimeError
     * @throws SyntaxError
     * @throws LoaderError
     */
    #[Route('/articles/auteur/{slug:author}', name: 'article_list_by_author')]
    public function __invoke(Author $author): Response
    {
        $articles = $this->repository->findByAuthor($author);

        return ($this->responder)($author, $articles);
    }
}

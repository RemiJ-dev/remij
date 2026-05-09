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
    /**
     * @throws RuntimeError
     * @throws SyntaxError
     * @throws LoaderError
     */
    #[Route('/articles/auteur/{slug:author}', name: 'article_list_by_author')]
    public function __invoke(
        Author $author,
        ArticleRepository $repository,
        ListByAuthorResponder $responder,
    ): Response {
        $articles = $repository->findByAuthor($author);

        return ($responder)($author, $articles);
    }
}

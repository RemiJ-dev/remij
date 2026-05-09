<?php

declare(strict_types=1);

namespace App\Responder\Article;

use App\Domain\Article\Model\Article;
use App\Domain\Article\Model\Author;
use Symfony\Component\HttpFoundation\Response;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

class ListByAuthorResponder extends AbstractArticleResponder
{
    /**
     * @param array<string, Article> $articles
     *
     * @throws RuntimeError
     * @throws SyntaxError
     * @throws LoaderError
     */
    public function __invoke(Author $author, array $articles): Response
    {
        return $this->render('articles/list_by_author.html.twig', [
            'articles' => $articles,
            'author' => $author,
        ])->setLastModified($this->getLastModified($articles));
    }
}

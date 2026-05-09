<?php

declare(strict_types=1);

namespace App\Responder\Article;

use App\Domain\Article\Model\Article;
use Symfony\Component\HttpFoundation\Response;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

class ListResponder extends AbstractArticleResponder
{
    /**
     * @param array<string, Article> $articles
     *
     * @throws RuntimeError
     * @throws SyntaxError
     * @throws LoaderError
     */
    public function __invoke(array $articles): Response
    {
        return $this->render('articles/list.html.twig', [
            'articles' => $articles,
        ])->setLastModified($this->getLastModified($articles));
    }
}

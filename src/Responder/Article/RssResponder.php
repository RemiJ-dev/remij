<?php

declare(strict_types=1);

namespace App\Responder\Article;

use App\Domain\Article\Model\Article;
use Symfony\Component\HttpFoundation\Response;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

class RssResponder extends AbstractArticleResponder
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
        $lastModified = $this->lastModified($articles);

        $response = $this->render('rss/rss.xml.twig', [
            'articles' => $articles,
            'lastModified' => $lastModified,
        ])->setLastModified($lastModified);
        $response->headers->set('Content-Type', 'application/atom+xml; charset=utf-8');

        return $response;
    }
}

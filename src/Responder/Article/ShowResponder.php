<?php

declare(strict_types=1);

namespace App\Responder\Article;

use App\Domain\Article\Model\Article;
use App\Responder\AbstractTwigResponder;
use Symfony\Component\HttpFoundation\Response;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

class ShowResponder extends AbstractTwigResponder
{
    /**
     * @throws RuntimeError
     * @throws SyntaxError
     * @throws LoaderError
     */
    public function __invoke(Article $article): Response
    {
        return $this->render('articles/show.html.twig', [
            'article' => $article,
        ])->setLastModified($article->getLastModifiedOrCreated());
    }
}

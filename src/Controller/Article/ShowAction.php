<?php

declare(strict_types=1);

namespace App\Controller\Article;

use App\Model\Article;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

readonly class ShowAction
{
    public function __construct(private Environment $twig)
    {
    }

    /**
     * @throws SyntaxError
     * @throws RuntimeError
     * @throws LoaderError
     */
    #[Route('/articles/{slug:article}', name: 'article_show', requirements: ['slug' => '.+'])]
    public function __invoke(Article $article): Response
    {
        return new Response($this->twig->render('articles/show.html.twig', [
            'article' => $article,
        ]))->setLastModified($article->getLastModifiedOrCreated());
    }
}

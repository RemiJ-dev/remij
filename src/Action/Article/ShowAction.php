<?php

declare(strict_types=1);

namespace App\Action\Article;

use App\Domain\Article\Model\Article;
use App\Responder\Article\ShowResponder;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

readonly class ShowAction
{
    /**
     * @throws SyntaxError
     * @throws RuntimeError
     * @throws LoaderError
     */
    #[Route('/articles/{slug:article}', name: 'article_show', requirements: ['slug' => '.+'])]
    public function __invoke(
        Article $article,
        ShowResponder $responder,
    ): Response {
        return ($responder)($article);
    }
}

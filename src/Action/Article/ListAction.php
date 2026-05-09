<?php

declare(strict_types=1);

namespace App\Action\Article;

use App\Domain\Article\Repository\ArticleRepository;
use App\Responder\Article\ListResponder;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

readonly class ListAction
{
    /**
     * @throws RuntimeError
     * @throws SyntaxError
     * @throws LoaderError
     */
    #[Route('/articles/', name: 'article_list')]
    public function __invoke(
        ArticleRepository $repository,
        ListResponder $responder,
    ): Response {
        return ($responder)($repository->findPublished());
    }
}

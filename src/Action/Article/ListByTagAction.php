<?php

declare(strict_types=1);

namespace App\Action\Article;

use App\Domain\Article\Repository\ArticleRepository;
use App\Responder\Article\ListByTagResponder;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

readonly class ListByTagAction
{
    public function __construct(
        private ArticleRepository $repository,
        private ListByTagResponder $responder,
    ) {
    }

    /**
     * @throws RuntimeError
     * @throws SyntaxError
     * @throws LoaderError
     */
    #[Route('/articles/tag/{tag:tag}', name: 'article_list_by_tag')]
    public function __invoke(string $tag): Response
    {
        $articles = $this->repository->findByTag($tag);

        return ($this->responder)($tag, $articles);
    }
}

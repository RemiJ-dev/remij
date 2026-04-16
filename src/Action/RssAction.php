<?php

declare(strict_types=1);

namespace App\Action;

use App\Domain\Article\Repository\ArticleRepository;
use App\Responder\Article\RssResponder;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

readonly class RssAction
{
    public function __construct(
        private ArticleRepository $repository,
        private RssResponder $responder,
    ) {
    }

    /**
     * @throws RuntimeError
     * @throws SyntaxError
     * @throws LoaderError
     */
    #[Route(path: '/rss.xml', name: 'rss', methods: ['GET'])]
    public function __invoke(): Response
    {
        return ($this->responder)($this->repository->findPublished());
    }
}

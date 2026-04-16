<?php

declare(strict_types=1);

namespace App\Action\Seo;

use App\Domain\Article\Repository\ArticleRepository;
use App\Domain\Page\Repository\PageRepository;
use App\Responder\Seo\SitemapResponder;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

readonly class SitemapAction
{
    public function __construct(
        private ArticleRepository $articleRepository,
        private PageRepository $pageRepository,
        private SitemapResponder $responder,
    ) {
    }

    /**
     * @throws RuntimeError
     * @throws SyntaxError
     * @throws LoaderError
     */
    #[Route('/sitemap.xml', name: 'seo_sitemap')]
    public function __invoke(): Response
    {
        return ($this->responder)(
            $this->articleRepository->findPublished(),
            $this->pageRepository->findAll(),
        );
    }
}

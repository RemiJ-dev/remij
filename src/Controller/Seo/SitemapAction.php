<?php

declare(strict_types=1);

namespace App\Controller\Seo;

use App\Model\Article;
use App\Model\Page;
use Stenope\Bundle\ContentManagerInterface;
use Stenope\Bundle\Service\ContentUtils;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

readonly class SitemapAction
{
    public function __construct(
        private Environment $twig,
        private ContentManagerInterface $manager,
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
        /** @var Article[] $articles */
        $articles = $this->manager->getContents(Article::class, ['publishedAt' => false], '_.isPublished()');

        /** @var Page[] $pages */
        $pages = $this->manager->getContents(Page::class);

        /** @var array<string, \DateTimeInterface> $tags */
        $tags = [];
        foreach ($articles as $article) {
            $date = $article->getLastModifiedOrCreated();
            foreach ($article->tags as $tag) {
                if (!isset($tags[$tag]) || $date > $tags[$tag]) {
                    $tags[$tag] = $date;
                }
            }
        }

        /** @var ?\DateTimeInterface $articlesLastModified */
        $articlesLastModified = ContentUtils::max($articles, 'lastModifiedOrCreated');

        $response = new Response($this->twig->render('seo/sitemap.xml.twig', [
            'articles' => $articles,
            'articlesLastModified' => $articlesLastModified,
            'pages' => array_filter($pages, static fn (Page $page): bool => 'home' !== $page->slug),
            'tags' => $tags,
        ]));
        $response->headers->set('Content-Type', 'application/xml; charset=utf-8');

        return $response;
    }
}

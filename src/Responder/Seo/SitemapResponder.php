<?php

declare(strict_types=1);

namespace App\Responder\Seo;

use App\Domain\Article\Model\Article;
use App\Domain\Page\Model\Page;
use App\Domain\Tutorial\Model\Chapter;
use App\Domain\Tutorial\Model\Tutorial;
use App\Responder\AbstractTwigResponder;
use Symfony\Component\HttpFoundation\Response;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

class SitemapResponder extends AbstractTwigResponder
{
    /**
     * @param array<string, Article>            $articles
     * @param array<string, Tutorial>           $tutorials
     * @param array<string, Chapter>            $chapters
     * @param array<string, Page>               $pages
     * @param array<string, \DateTimeInterface> $tags
     * @param array<string, \DateTimeInterface> $authors
     *
     * @throws RuntimeError
     * @throws SyntaxError
     * @throws LoaderError
     */
    public function __invoke(array $articles, array $tutorials, array $chapters, array $pages, array $tags, array $authors): Response
    {
        $response = $this->render('seo/sitemap.xml.twig', [
            'articles' => $articles,
            'articlesLastModified' => $this->getLastModified($articles),
            'tutorials' => $tutorials,
            'tutorialsLastModified' => $this->getLastModified([...$tutorials, ...$chapters]),
            'chapters' => $chapters,
            'pages' => array_filter($pages, static fn (Page $page): bool => 'home' !== $page->slug),
            'tags' => $tags,
            'authors' => $authors,
        ]);
        $response->headers->set('Content-Type', 'application/xml; charset=utf-8');

        return $response;
    }
}

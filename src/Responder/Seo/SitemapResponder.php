<?php

declare(strict_types=1);

namespace App\Responder\Seo;

use App\Domain\Article\Model\Article;
use App\Domain\Page\Model\Page;
use App\Responder\AbstractTwigResponder;
use Symfony\Component\HttpFoundation\Response;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

class SitemapResponder extends AbstractTwigResponder
{
    /**
     * @param array<string, Article> $articles
     * @param array<string, Page>    $pages
     *
     * @throws RuntimeError
     * @throws SyntaxError
     * @throws LoaderError
     */
    public function __invoke(array $articles, array $pages): Response
    {
        /** @var array<string, \DateTimeInterface> $tags */
        $tags = [];
        /** @var array<string, \DateTimeInterface> $authors */
        $authors = [];
        foreach ($articles as $article) {
            $date = $article->getLastModifiedOrCreated();
            foreach ($article->tags as $tag) {
                if (!isset($tags[$tag]) || $date > $tags[$tag]) {
                    $tags[$tag] = $date;
                }
            }
            foreach ($article->authors as $authorSlug) {
                if (!isset($authors[$authorSlug]) || $date > $authors[$authorSlug]) {
                    $authors[$authorSlug] = $date;
                }
            }
        }

        $response = $this->render('seo/sitemap.xml.twig', [
            'articles' => $articles,
            'articlesLastModified' => [] !== $articles ? max(array_map(
                static fn (Article $a): \DateTimeInterface => $a->getLastModifiedOrCreated(),
                $articles,
            )) : null,
            'pages' => array_filter($pages, static fn (Page $page): bool => 'home' !== $page->slug),
            'tags' => $tags,
            'authors' => $authors,
        ]);
        $response->headers->set('Content-Type', 'application/xml; charset=utf-8');

        return $response;
    }
}

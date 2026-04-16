<?php

declare(strict_types=1);

namespace App\Tests\Controller;

use App\Domain\Article\Model\Article;
use App\Domain\Page\Model\Page;
use App\Tests\Helper\RouteDiscoveryTrait;
use Stenope\Bundle\ContentManagerInterface;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class SitemapActionTest extends WebTestCase
{
    use RouteDiscoveryTrait;

    public function testSitemapReturns200(): void
    {
        $client = static::createClient();
        $client->request('GET', '/sitemap.xml');

        self::assertResponseIsSuccessful();
    }

    /**
     * @throws \Exception
     */
    public function testSitemapContainsAllExpectedUrls(): void
    {
        $client = static::createClient();
        $client->request('GET', '/sitemap.xml');

        $content = $client->getResponse()->getContent();
        self::assertNotFalse($content);

        $xml = new \SimpleXMLElement($content);

        $locs = [];
        foreach ($xml->url as $url) {
            $locs[] = (string) $url->loc;
        }

        $container = static::getContainer();

        $router = $container->get('router');

        $manager = $container->get(ContentManagerInterface::class);

        /** @var Article[] $articles */
        $articles = $manager->getContents(Article::class, ['publishedAt' => false], '_.isPublished()');

        /** @var Page[] $pages */
        $pages = $manager->getContents(Page::class);

        $tags = [];
        foreach ($articles as $article) {
            foreach ($article->tags as $tag) {
                $tags[$tag] = true;
            }
        }

        $actionsDir = \dirname(__DIR__, 2) . '/src/Action';
        $excludedRoutes = ['rss', 'seo_robots', 'seo_sitemap'];

        // Static routes (no parameters), excluding Seo controllers and non-HTML routes
        foreach (self::discoverControllerRoutes($actionsDir, ['Seo']) as $route) {
            if ([] !== $route['params'] || \in_array($route['name'], $excludedRoutes, true)) {
                continue;
            }
            $url = $router->generate($route['name'], [], UrlGeneratorInterface::ABSOLUTE_URL);
            self::assertContains($url, $locs, \sprintf('Route "%s" is missing from sitemap.', $route['name']));
        }

        // One URL per published article
        foreach ($articles as $article) {
            $url = $router->generate('article_show', ['slug' => $article->slug], UrlGeneratorInterface::ABSOLUTE_URL);
            self::assertContains($url, $locs, \sprintf('Article "%s" is missing from sitemap.', $article->slug));
        }

        // One URL per unique tag from published articles
        foreach (array_keys($tags) as $tag) {
            $url = $router->generate('article_list_by_tag', ['tag' => $tag], UrlGeneratorInterface::ABSOLUTE_URL);
            self::assertContains($url, $locs, \sprintf('Tag "%s" is missing from sitemap.', $tag));
        }

        // One URL per unique author from published articles
        $authorSlugs = [];
        foreach ($articles as $article) {
            foreach ($article->authors as $authorSlug) {
                $authorSlugs[$authorSlug] = true;
            }
        }
        foreach (array_keys($authorSlugs) as $authorSlug) {
            $url = $router->generate('article_list_by_author', ['slug' => $authorSlug], UrlGeneratorInterface::ABSOLUTE_URL);
            self::assertContains($url, $locs, \sprintf('Author "%s" is missing from sitemap.', $authorSlug));
        }

        // One URL per page, excluding "home" (which redirects to /)
        foreach ($pages as $page) {
            if ('home' === $page->slug) {
                continue;
            }
            $url = $router->generate('page_content', ['slug' => $page->slug], UrlGeneratorInterface::ABSOLUTE_URL);
            self::assertContains($url, $locs, \sprintf('Page "%s" is missing from sitemap.', $page->slug));
        }
    }
}

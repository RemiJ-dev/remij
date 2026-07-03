<?php

declare(strict_types=1);

namespace App\Tests\Action;

use App\Domain\Article\Model\Article;
use App\Domain\Page\Model\Page;
use App\Domain\Tutorial\Model\Chapter;
use App\Domain\Tutorial\Model\Tutorial;
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

        /** @var array<string, Tutorial> $tutorials */
        $tutorials = $manager->getContents(Tutorial::class, ['publishedAt' => false], '_.isPublished()');

        /** @var Chapter[] $chapters */
        $chapters = array_filter(
            $manager->getContents(Chapter::class, [], '_.isPublished()'),
            static fn (Chapter $chapter): bool => \array_key_exists($chapter->getTutorialSlug(), $tutorials),
        );

        /** @var Page[] $pages */
        $pages = $manager->getContents(Page::class);

        $tags = [];
        foreach ([...array_values($articles), ...array_values($tutorials)] as $publication) {
            foreach ($publication->tags as $tag) {
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

        // One URL per published tutorial, plus one per published chapter of a published tutorial
        foreach ($tutorials as $tutorial) {
            $url = $router->generate('tutorial_show', ['slug' => $tutorial->slug], UrlGeneratorInterface::ABSOLUTE_URL);
            self::assertContains($url, $locs, \sprintf('Tutorial "%s" is missing from sitemap.', $tutorial->slug));
        }
        foreach ($chapters as $chapter) {
            $url = $router->generate('tutorial_chapter', ['slug' => $chapter->slug], UrlGeneratorInterface::ABSOLUTE_URL);
            self::assertContains($url, $locs, \sprintf('Chapter "%s" is missing from sitemap.', $chapter->slug));
        }

        // One URL per unique tag from published articles and tutorials
        foreach (array_keys($tags) as $tag) {
            $url = $router->generate('publication_list_by_tag', ['tag' => $tag], UrlGeneratorInterface::ABSOLUTE_URL);
            self::assertContains($url, $locs, \sprintf('Tag "%s" is missing from sitemap.', $tag));
        }

        // One URL per unique author from published articles and tutorials
        $authorSlugs = [];
        foreach ([...array_values($articles), ...array_values($tutorials)] as $publication) {
            foreach ($publication->authors as $authorSlug) {
                $authorSlugs[$authorSlug] = true;
            }
        }
        foreach (array_keys($authorSlugs) as $authorSlug) {
            $url = $router->generate('publication_list_by_author', ['slug' => $authorSlug], UrlGeneratorInterface::ABSOLUTE_URL);
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

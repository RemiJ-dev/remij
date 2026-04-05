<?php

declare(strict_types=1);

namespace App\Tests\Controller;

use App\Model\Article;
use Stenope\Bundle\ContentManagerInterface;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class RssActionTest extends WebTestCase
{
    private const string ATOM_NS = 'http://www.w3.org/2005/Atom';

    public function testRssReturns200(): void
    {
        $client = static::createClient();
        $client->request('GET', '/rss.xml');

        self::assertResponseIsSuccessful();
    }

    public function testRssContentTypeIsAtomXml(): void
    {
        $client = static::createClient();
        $client->request('GET', '/rss.xml');

        self::assertResponseHeaderSame('Content-Type', 'application/atom+xml; charset=utf-8');
    }

    /**
     * @throws \Exception
     */
    public function testRssIsValidXmlWithFeedRoot(): void
    {
        $client = static::createClient();
        $client->request('GET', '/rss.xml');

        $content = $client->getResponse()->getContent();
        self::assertNotFalse($content);

        $xml = new \SimpleXMLElement($content);
        self::assertSame('feed', $xml->getName());
        self::assertSame(self::ATOM_NS, $xml->getNamespaces()[''] ?? '');
    }

    /**
     * @throws \Exception
     */
    public function testRssArticleCountMatchesPublishedArticles(): void
    {
        $client = static::createClient();
        $client->request('GET', '/rss.xml');

        $content = $client->getResponse()->getContent();
        self::assertNotFalse($content);

        $entries = $this->getEntries(new \SimpleXMLElement($content));

        $manager = static::getContainer()->get(ContentManagerInterface::class);

        $publishedArticles = $manager->getContents(Article::class, ['publishedAt' => false], '_.isPublished()');

        self::assertCount(\count($publishedArticles), $entries);
    }

    /**
     * @throws \DateMalformedStringException
     * @throws \Exception
     */
    public function testRssArticlesAreInReverseChronologicalOrder(): void
    {
        $client = static::createClient();
        $client->request('GET', '/rss.xml');

        $content = $client->getResponse()->getContent();
        self::assertNotFalse($content);

        $entries = $this->getEntries(new \SimpleXMLElement($content));

        if (\count($entries) < 2) {
            self::markTestSkipped('Not enough articles to test ordering.');
        }

        $dates = array_map(
            fn (\SimpleXMLElement $entry): \DateTimeImmutable => new \DateTimeImmutable(
                (string) $entry->children(self::ATOM_NS)->published,
            ),
            $entries,
        );

        for ($i = 0; $i < \count($dates) - 1; ++$i) {
            self::assertGreaterThanOrEqual(
                $dates[$i + 1],
                $dates[$i],
                \sprintf(
                    'Article %d (%s) should be more recent than article %d (%s)',
                    $i,
                    $dates[$i]->format('Y-m-d'),
                    $i + 1,
                    $dates[$i + 1]->format('Y-m-d'),
                ),
            );
        }
    }

    /**
     * @throws \DateMalformedStringException
     * @throws \Exception
     */
    public function testRssLastModifiedMatchesMostRecentArticle(): void
    {
        $client = static::createClient();
        $client->request('GET', '/rss.xml');

        $content = $client->getResponse()->getContent();
        self::assertNotFalse($content);

        $xml = new \SimpleXMLElement($content);

        $feedUpdated = new \DateTimeImmutable(
            (string) $xml->children(self::ATOM_NS)->updated,
        );

        $entries = $this->getEntries($xml);
        self::assertNotEmpty($entries, 'Feed must contain at least one entry.');

        $maxEntryDate = null;
        foreach ($entries as $entry) {
            $date = new \DateTimeImmutable((string) $entry->children(self::ATOM_NS)->updated);
            if (null === $maxEntryDate || $date > $maxEntryDate) {
                $maxEntryDate = $date;
            }
        }
        self::assertNotNull($maxEntryDate);

        self::assertEquals($maxEntryDate, $feedUpdated);
    }

    /** @return list<\SimpleXMLElement> */
    private function getEntries(\SimpleXMLElement $xml): array
    {
        $entries = [];

        foreach ($xml->children(self::ATOM_NS) as $child) {
            if ('entry' === $child->getName()) {
                $entries[] = $child;
            }
        }

        return $entries;
    }
}

<?php

declare(strict_types=1);

namespace App\Tests\Controller;

use PHPUnit\Framework\Attributes\DataProvider;
use Stenope\Bundle\Exception\ContentNotFoundException;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\Finder\Finder;

class ArticleControllerTest extends WebTestCase
{
    public function testListReturns200(): void
    {
        $client = static::createClient();
        $client->request('GET', '/articles/');

        self::assertResponseIsSuccessful();
    }

    /** @return array<string, array{string}> */
    public static function existingArticleSlugs(): array
    {
        $slugs = [];

        $files = new Finder()->files()->name('*.md')->in(__DIR__ . '/../../content/articles/');

        foreach ($files as $file) {
            $slug = $file->getFilenameWithoutExtension();
            $slugs[$slug] = [$slug];
        }

        return $slugs;
    }

    #[DataProvider('existingArticleSlugs')]
    public function testShowExistingArticleReturns200(string $slug): void
    {
        $client = static::createClient();
        $client->request('GET', '/articles/' . $slug);

        self::assertResponseIsSuccessful();
    }

    public function testShowNonExistingArticleThrowsNotFoundException(): void
    {
        $client = static::createClient();
        $client->catchExceptions(false);

        self::expectException(ContentNotFoundException::class);

        $client->request('GET', '/articles/article-inexistant');
    }
}

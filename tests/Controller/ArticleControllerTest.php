<?php

declare(strict_types=1);

namespace App\Tests\Controller;

use App\Domain\Article\Model\Article;
use PHPUnit\Framework\Attributes\DataProvider;
use Stenope\Bundle\ContentManagerInterface;
use Stenope\Bundle\Exception\ContentNotFoundException;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

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
        self::bootKernel();

        $manager = static::getContainer()->get(ContentManagerInterface::class);

        $articles = $manager->getContents(Article::class);

        self::ensureKernelShutdown();

        $slugs = [];
        foreach ($articles as $article) {
            $slugs[$article->slug] = [$article->slug];
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

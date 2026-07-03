<?php

declare(strict_types=1);

namespace App\Tests\Action;

use App\Domain\Article\Model\Article;
use App\Domain\Publication\Model\Author;
use App\Domain\Tutorial\Model\Tutorial;
use PHPUnit\Framework\Attributes\DataProvider;
use Stenope\Bundle\ContentManagerInterface;
use Stenope\Bundle\Exception\ContentNotFoundException;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class PublicationActionsTest extends WebTestCase
{
    /** @return array<string, array{string}> */
    public static function publishedTags(): array
    {
        self::bootKernel();

        $manager = static::getContainer()->get(ContentManagerInterface::class);

        /** @var Article[] $articles */
        $articles = $manager->getContents(Article::class, [], '_.isPublished()');
        /** @var Tutorial[] $tutorials */
        $tutorials = $manager->getContents(Tutorial::class, [], '_.isPublished()');

        self::ensureKernelShutdown();

        $tags = [];
        foreach ([...array_values($articles), ...array_values($tutorials)] as $publication) {
            foreach ($publication->tags as $tag) {
                $tags[$tag] = [$tag];
            }
        }

        return $tags;
    }

    #[DataProvider('publishedTags')]
    public function testTagPageReturns200(string $tag): void
    {
        $client = static::createClient();
        $client->request('GET', '/tag/' . $tag);

        self::assertResponseIsSuccessful();
    }

    public function testUnknownTagReturns200WithEmptyList(): void
    {
        $client = static::createClient();
        $client->request('GET', '/tag/tag-inexistant');

        self::assertResponseIsSuccessful();
    }

    /** @return array<string, array{string}> */
    public static function existingAuthorSlugs(): array
    {
        self::bootKernel();

        $manager = static::getContainer()->get(ContentManagerInterface::class);

        /** @var Author[] $authors */
        $authors = $manager->getContents(Author::class);

        self::ensureKernelShutdown();

        $slugs = [];
        foreach ($authors as $author) {
            $slugs[$author->slug] = [$author->slug];
        }

        return $slugs;
    }

    #[DataProvider('existingAuthorSlugs')]
    public function testAuthorPageReturns200(string $slug): void
    {
        $client = static::createClient();
        $client->request('GET', '/auteur/' . $slug);

        self::assertResponseIsSuccessful();
    }

    public function testUnknownAuthorThrowsNotFoundException(): void
    {
        $client = static::createClient();
        $client->catchExceptions(false);

        self::expectException(ContentNotFoundException::class);

        $client->request('GET', '/auteur/auteur-inexistant');
    }
}

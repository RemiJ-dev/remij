<?php

declare(strict_types=1);

namespace App\Tests\Action;

use App\Domain\Tutorial\Model\Chapter;
use App\Domain\Tutorial\Model\Tutorial;
use PHPUnit\Framework\Attributes\DataProvider;
use Stenope\Bundle\ContentManagerInterface;
use Stenope\Bundle\Exception\ContentNotFoundException;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class TutorialActionsTest extends WebTestCase
{
    public function testListReturns200(): void
    {
        $client = static::createClient();
        $client->request('GET', '/tutoriels/');

        self::assertResponseIsSuccessful();
    }

    /** @return array<string, array{string}> */
    public static function existingTutorialSlugs(): array
    {
        self::bootKernel();

        $manager = static::getContainer()->get(ContentManagerInterface::class);

        $tutorials = $manager->getContents(Tutorial::class);

        self::ensureKernelShutdown();

        $slugs = [];
        foreach ($tutorials as $tutorial) {
            $slugs[$tutorial->slug] = [$tutorial->slug];
        }

        return $slugs;
    }

    #[DataProvider('existingTutorialSlugs')]
    public function testShowExistingTutorialReturns200(string $slug): void
    {
        $client = static::createClient();
        $client->request('GET', '/tutoriels/' . $slug);

        self::assertResponseIsSuccessful();
    }

    /** @return array<string, array{string}> */
    public static function existingChapterSlugs(): array
    {
        self::bootKernel();

        $manager = static::getContainer()->get(ContentManagerInterface::class);

        $chapters = $manager->getContents(Chapter::class);

        self::ensureKernelShutdown();

        $slugs = [];
        foreach ($chapters as $chapter) {
            $slugs[$chapter->slug] = [$chapter->slug];
        }

        return $slugs;
    }

    #[DataProvider('existingChapterSlugs')]
    public function testShowExistingChapterReturns200(string $slug): void
    {
        $client = static::createClient();
        $client->request('GET', '/tutoriels/' . $slug);

        self::assertResponseIsSuccessful();
    }

    public function testShowNonExistingTutorialThrowsNotFoundException(): void
    {
        $client = static::createClient();
        $client->catchExceptions(false);

        self::expectException(ContentNotFoundException::class);

        $client->request('GET', '/tutoriels/tutoriel-inexistant');
    }

    public function testShowNonExistingChapterThrowsNotFoundException(): void
    {
        $client = static::createClient();
        $client->catchExceptions(false);

        self::expectException(ContentNotFoundException::class);

        $client->request('GET', '/tutoriels/symfony-les-bases/partie-inexistante');
    }
}

<?php

declare(strict_types=1);

namespace App\Tests\Controller;

use App\Model\Page;
use PHPUnit\Framework\Attributes\DataProvider;
use Stenope\Bundle\ContentManagerInterface;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class DefaultControllerTest extends WebTestCase
{
    public function testHomeReturns200(): void
    {
        $client = static::createClient();
        $client->request('GET', '/');

        self::assertResponseIsSuccessful();
    }

    /**
     * Slugs excluded from the catch-all route test:
     * - "home"    → redirects to page_home (302)
     * - "contact" → has its own dedicated route
     *
     * @return array<string, array{string}>
     */
    public static function existingPageSlugs(): array
    {
        $excluded = ['home', 'contact'];

        self::bootKernel();

        $manager = static::getContainer()->get(ContentManagerInterface::class);

        $pages = $manager->getContents(Page::class);

        self::ensureKernelShutdown();

        $slugs = [];
        foreach ($pages as $page) {
            if (\in_array($page->slug, $excluded, true)) {
                continue;
            }
            $slugs[$page->slug] = [$page->slug];
        }

        return $slugs;
    }

    #[DataProvider('existingPageSlugs')]
    public function testExistingPageReturns200(string $slug): void
    {
        $client = static::createClient();
        $client->request('GET', '/' . $slug);

        self::assertResponseIsSuccessful();
    }

    public function testNonExistingPageThrowsNotFoundException(): void
    {
        $client = static::createClient();
        $client->catchExceptions(false);

        self::expectException(NotFoundHttpException::class);

        $client->request('GET', '/page-inexistante');
    }
}

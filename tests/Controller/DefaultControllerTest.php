<?php

declare(strict_types=1);

namespace App\Tests\Controller;

use PHPUnit\Framework\Attributes\DataProvider;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\Finder\Finder;
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
        $slugs = [];

        $files = new Finder()->files()->name('*.md')->in(__DIR__ . '/../../content/pages/');

        foreach ($files as $file) {
            $slug = $file->getFilenameWithoutExtension();

            if (\in_array($slug, $excluded, true)) {
                continue;
            }

            $slugs[$slug] = [$slug];
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

<?php

declare(strict_types=1);

namespace App\Tests\Action;

use App\Domain\Page\Model\Page;
use PHPUnit\Framework\Attributes\DataProvider;
use Stenope\Bundle\ContentManagerInterface;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class DefaultActionsTest extends WebTestCase
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

    /**
     * Encoded slashes are decoded before routing: the catch-all route must not
     * match the resulting non-canonical paths, which resolve to real content
     * once the filesystem and the Twig loader collapse the extra slashes.
     *
     * @return array<string, array{string}>
     */
    public static function nonCanonicalPaths(): array
    {
        return [
            'encoded slash before a slug with a dedicated template' => ['/%2fcontact'],
            'several encoded slashes' => ['/%2f%2fcontact'],
            'encoded slash before a generic page' => ['/%2fmentions-legales'],
        ];
    }

    #[DataProvider('nonCanonicalPaths')]
    public function testNonCanonicalPathThrowsNotFoundException(string $path): void
    {
        $client = static::createClient();
        $client->catchExceptions(false);

        self::expectException(NotFoundHttpException::class);

        $client->request('GET', $path);
    }
}

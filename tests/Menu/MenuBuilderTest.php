<?php

declare(strict_types=1);

namespace App\Tests\Menu;

use App\Menu\MenuBuilder;
use App\Tests\Helper\RouteDiscoveryTrait;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;

#[CoversClass(MenuBuilder::class)]
class MenuBuilderTest extends TestCase
{
    use RouteDiscoveryTrait;
    /** @var array<string, int> */
    private const array EXPECTED_BREADCRUMB_COUNTS = [
        'page_home' => 1,
        'page_contact' => 2,
        'page_content' => 2,
        'article_list' => 2,
        'article_list_by_tag' => 3,
        'article_show' => 3,
        'rss' => 1,
        'seo_robots' => 1,
        'seo_sitemap' => 1,
    ];

    /**
     * @return array<string, array{string, array<string, string>, int}>
     */
    public static function routeBreadcrumbData(): array
    {
        $routes = self::discoverControllerRoutes(\dirname(__DIR__, 2) . '/src/Controller');

        $cases = [];

        foreach ($routes as $route) {
            $routeParams = array_fill_keys($route['params'], 'test-value');

            if (!\array_key_exists($route['name'], self::EXPECTED_BREADCRUMB_COUNTS)) {
                throw new \LogicException(\sprintf(
                    'Route "%s" is missing from EXPECTED_BREADCRUMB_COUNTS. Please update the test.',
                    $route['name'],
                ));
            }

            $cases[$route['name']] = [$route['name'], $routeParams, self::EXPECTED_BREADCRUMB_COUNTS[$route['name']]];
        }

        return $cases;
    }

    /**
     * @param array<string, string> $routeParams
     */
    #[DataProvider('routeBreadcrumbData')]
    public function testBreadcrumbReturnsExpectedCountForRoute(
        string $routeName,
        array $routeParams,
        int $expectedCount,
    ): void {
        $request = new Request();
        $request->attributes->set('_route', $routeName);
        $request->attributes->set('_route_params', $routeParams);

        $requestStack = new RequestStack();
        $requestStack->push($request);

        $breadcrumb = new MenuBuilder($requestStack)->breadcrumb();

        self::assertCount(
            $expectedCount,
            $breadcrumb,
            \sprintf('Route "%s" should produce %d breadcrumb item(s).', $routeName, $expectedCount),
        );
    }

    public function testBreadcrumbWithNoRequestReturnsHomeOnly(): void
    {
        $breadcrumb = new MenuBuilder(new RequestStack())->breadcrumb();

        self::assertCount(1, $breadcrumb);
        self::assertSame('page_home', $breadcrumb[0]['route']);
    }
}

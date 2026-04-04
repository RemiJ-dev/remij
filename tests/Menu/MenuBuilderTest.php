<?php

declare(strict_types=1);

namespace App\Tests\Menu;

use App\Menu\MenuBuilder;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Finder\Finder;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Routing\Attribute\Route;

#[CoversClass(MenuBuilder::class)]
class MenuBuilderTest extends TestCase
{
    /** @var array<string, int> */
    private const array EXPECTED_BREADCRUMB_COUNTS = [
        'page_home' => 1,
        'page_contact' => 2,
        'page_content' => 2,
        'article_list' => 2,
        'article_list_by_tag' => 3,
        'article_show' => 3,
        'rss' => 1,
    ];

    /**
     * @return array<string, array{string, array<string, string>, int}>
     */
    public static function routeBreadcrumbData(): array
    {
        $controllerDir = \dirname(__DIR__, 2) . '/src/Controller';
        $finder = new Finder()->files()->in($controllerDir)->name('*.php');

        $cases = [];

        foreach ($finder as $file) {
            $content = $file->getContents();

            preg_match('/^namespace\s+(\S+);/m', $content, $nsMatch);
            preg_match('/^(?:readonly\s+)?class\s+(\w+)/m', $content, $classMatch);

            if (!isset($nsMatch[1], $classMatch[1])) {
                continue;
            }

            $className = $nsMatch[1] . '\\' . $classMatch[1];
            if (!class_exists($className)) {
                continue;
            }

            $refClass = new \ReflectionClass($className);

            $classNamePrefix = '';
            $classPathPrefix = '';
            foreach ($refClass->getAttributes(Route::class) as $classAttr) {
                $instance = $classAttr->newInstance();
                $classNamePrefix = $instance->name ?? '';
                $classPathPrefix = \is_string($instance->path) ? $instance->path : '';
            }

            foreach ($refClass->getMethods(\ReflectionMethod::IS_PUBLIC) as $method) {
                if ($method->getDeclaringClass()->getName() !== $className) {
                    continue;
                }

                foreach ($method->getAttributes(Route::class) as $methodAttr) {
                    $instance = $methodAttr->newInstance();
                    if (!\is_string($instance->path)) {
                        continue;
                    }

                    $routeName = $classNamePrefix . ($instance->name ?? '');
                    $fullPath = $classPathPrefix . $instance->path;

                    preg_match_all('/\{(\w+)}/', $fullPath, $matches);
                    $routeParams = array_fill_keys($matches[1], 'test-value');

                    if (!\array_key_exists($routeName, self::EXPECTED_BREADCRUMB_COUNTS)) {
                        throw new \LogicException(\sprintf(
                            'Route "%s" is missing from EXPECTED_BREADCRUMB_COUNTS. Please update the test.',
                            $routeName,
                        ));
                    }

                    $cases[$routeName] = [$routeName, $routeParams, self::EXPECTED_BREADCRUMB_COUNTS[$routeName]];
                }
            }
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

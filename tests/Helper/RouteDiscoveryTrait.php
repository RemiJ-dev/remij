<?php

declare(strict_types=1);

namespace App\Tests\Helper;

use Symfony\Component\Finder\Finder;
use Symfony\Component\Routing\Attribute\Route;

trait RouteDiscoveryTrait
{
    /**
     * Discovers all routes defined via #[Route] attributes in the given controller directory.
     *
     * @param list<string> $excludePaths Subdirectory names to exclude (e.g. ['Seo'])
     *
     * @return list<array{name: string, path: string, params: list<string>}>
     */
    protected static function discoverControllerRoutes(string $dir, array $excludePaths = []): array
    {
        $finder = new Finder()->files()->in($dir)->name('*.php');
        foreach ($excludePaths as $path) {
            $finder->notPath($path);
        }

        $routes = [];

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

                    // Handle both {param} and {param:mapping} syntaxes
                    preg_match_all('/\{(\w+)(?::[^}]*)?}/', $fullPath, $matches);

                    $routes[] = [
                        'name' => $routeName,
                        'path' => $fullPath,
                        'params' => $matches[1],
                    ];
                }
            }
        }

        return $routes;
    }
}

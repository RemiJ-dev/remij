<?php

declare(strict_types=1);

namespace App\Menu;

use Symfony\Component\HttpFoundation\RequestStack;

readonly class MenuBuilder
{
    public function __construct(
        private RequestStack $requestStack,
    ) {
    }

    /** @return array<int, array<string, mixed>> */
    public function breadcrumb(): array
    {
        $currentRoute = $this->getCurrentRoute();
        /** @var array<string, mixed> $currentRouteParams */
        $currentRouteParams = $this->getCurrentRouteParams();
        $breadcrumb = [];

        $breadcrumb[] = [
            'route' => 'page_home',
            'routeParams' => [],
            'label' => 'Accueil',
            'currentRoute' => $currentRoute,
            'isActive' => 'page_home' === $currentRoute,
        ];

        if ('page_content' === $currentRoute) {
            $breadcrumb[] = [
                'route' => $currentRoute,
                'routeParams' => $currentRouteParams,
                'currentRoute' => $currentRoute,
                'isActive' => false,
            ];
        }

        if (\in_array($currentRoute, ['article_show', 'article_list_by_tag', 'article_list'])) {
            $breadcrumb[] = [
                'route' => 'article_list',
                'routeParams' => [],
                'label' => 'Blog',
                'currentRoute' => $currentRoute,
                'isActive' => 'article_list' === $currentRoute,
            ];
        }

        if (\in_array($currentRoute, ['article_show', 'article_list_by_tag'])) {
            $breadcrumb[] = [
                'route' => $currentRoute,
                'routeParams' => $currentRouteParams,
                'currentRoute' => $currentRoute,
                'isActive' => true,
            ];
        }

        return $breadcrumb;
    }

    private function getCurrentRoute(): string
    {
        /** @var ?string $route */
        $route = $this->requestStack->getCurrentRequest()?->attributes->get('_route', '');
        if (null === $route) {
            return '';
        }

        return (string) $route;
    }

    /**
     * @return array<string, mixed>
     */
    private function getCurrentRouteParams(): array
    {
        /** @var array<string, mixed>|null $params */
        $params = $this->requestStack->getCurrentRequest()?->attributes->get('_route_params');
        if (null === $params) {
            return [];
        }

        return $params;
    }
}

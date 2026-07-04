<?php

declare(strict_types=1);

namespace App\Infrastructure\Twig;

use App\Domain\Tutorial\Repository\TutorialRepository;
use Stenope\Bundle\Exception\ContentNotFoundException;
use Symfony\Component\HttpFoundation\RequestStack;

readonly class MenuBuilder
{
    public function __construct(
        private RequestStack $requestStack,
        private TutorialRepository $tutorialRepository,
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
            'label' => 'menu.home',
            'currentRoute' => $currentRoute,
            'isActive' => 'page_home' === $currentRoute,
        ];

        if ('page_content' === $currentRoute || 'page_contact' === $currentRoute) {
            $breadcrumb[] = [
                'route' => $currentRoute,
                'routeParams' => $currentRouteParams,
                'currentRoute' => $currentRoute,
                'isActive' => false,
            ];
        }

        if (\in_array($currentRoute, ['article_show', 'article_list'], true)) {
            $breadcrumb[] = [
                'route' => 'article_list',
                'routeParams' => [],
                'label' => 'menu.blog',
                'currentRoute' => $currentRoute,
                'isActive' => 'article_list' === $currentRoute,
            ];
        }

        if (\in_array($currentRoute, ['article_show', 'publication_list_by_tag', 'publication_list_by_author'], true)) {
            $breadcrumb[] = [
                'route' => $currentRoute,
                'routeParams' => $currentRouteParams,
                'currentRoute' => $currentRoute,
                'isActive' => true,
            ];
        }

        if (\in_array($currentRoute, ['tutorial_list', 'tutorial_show', 'tutorial_chapter'], true)) {
            $breadcrumb[] = [
                'route' => 'tutorial_list',
                'routeParams' => [],
                'label' => 'menu.tutorials',
                'currentRoute' => $currentRoute,
                'isActive' => 'tutorial_list' === $currentRoute,
            ];
        }

        if ('tutorial_chapter' === $currentRoute) {
            $breadcrumb[] = $this->tutorialItemForChapter($currentRoute, $currentRouteParams);
        }

        if (\in_array($currentRoute, ['tutorial_show', 'tutorial_chapter'], true)) {
            $breadcrumb[] = [
                'route' => $currentRoute,
                'routeParams' => $currentRouteParams,
                'currentRoute' => $currentRoute,
                'isActive' => true,
            ];
        }

        return $breadcrumb;
    }

    /**
     * Intermediate breadcrumb item for a chapter page: the tutorial it
     * belongs to, labelled with the tutorial title (not a translation key).
     *
     * @param array<string, mixed> $routeParams
     *
     * @return array<string, mixed>
     */
    private function tutorialItemForChapter(string $currentRoute, array $routeParams): array
    {
        $slug = $routeParams['slug'] ?? '';
        $tutorialSlug = \dirname(\is_string($slug) ? $slug : '');

        try {
            $label = $this->tutorialRepository->findBySlug($tutorialSlug)->title;
        } catch (ContentNotFoundException) {
            $label = $tutorialSlug;
        }

        return [
            'route' => 'tutorial_show',
            'routeParams' => ['slug' => $tutorialSlug],
            'label' => $label,
            'translate' => false,
            'currentRoute' => $currentRoute,
            'isActive' => false,
        ];
    }

    private function getCurrentRoute(): string
    {
        /** @var ?string $route */
        $route = $this->requestStack->getCurrentRequest()?->attributes->get('_route', '');
        if (null === $route) {
            return '';
        }

        return $route;
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

<?php

declare(strict_types=1);

namespace App\Action\Page;

use App\Domain\Page\Repository\PageRepository;
use App\Responder\Page\ContentResponder;
use Stenope\Bundle\Exception\ContentNotFoundException;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

readonly class ContentAction
{
    public function __construct(
        private PageRepository $pageRepository,
        private ContentResponder $responder,
        private UrlGeneratorInterface $urlGenerator,
    ) {
    }

    /**
     * @throws RuntimeError
     * @throws SyntaxError
     * @throws LoaderError
     *
     * This route is used to display pages from `content/pages`.
     * Since this is a catch-all route, it has a very low priority.
     */
    #[Route('/{slug}', name: 'page_content', requirements: ['slug' => '[^\.]+'], priority: -500)]
    public function __invoke(string $slug): Response
    {
        if ('home' === $slug) {
            return new RedirectResponse($this->urlGenerator->generate('page_home'));
        }

        try {
            $page = $this->pageRepository->findBySlug($slug);
        } catch (ContentNotFoundException $exception) {
            throw new NotFoundHttpException(\sprintf(
                'Page not found. Did you forget to create a `content/pages/%s.md` file?',
                $slug,
            ), $exception);
        }

        return ($this->responder)($slug, $page);
    }
}

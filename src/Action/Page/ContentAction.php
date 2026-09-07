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
    /**
     * @throws RuntimeError
     * @throws SyntaxError
     * @throws LoaderError
     */
    #[Route('/{slug<[^./]+(?:/[^./]+)*>}', name: 'page_content', priority: -500)]
    public function __invoke(
        string $slug,
        PageRepository $pageRepository,
        ContentResponder $responder,
        UrlGeneratorInterface $urlGenerator,
    ): Response {
        if ('home' === $slug) {
            return new RedirectResponse($urlGenerator->generate('page_home'));
        }

        try {
            $page = $pageRepository->findBySlug($slug);
        } catch (ContentNotFoundException $exception) {
            throw new NotFoundHttpException(\sprintf(
                'Page not found. Did you forget to create a `content/pages/%s.md` file?',
                $slug,
            ), $exception);
        }

        return $responder($slug, $page);
    }
}

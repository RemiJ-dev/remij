<?php

declare(strict_types=1);

namespace App\Controller\Page;

use App\Model\Page;
use Stenope\Bundle\ContentManagerInterface;
use Stenope\Bundle\Exception\ContentNotFoundException;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

readonly class ContentAction
{
    public function __construct(
        private Environment $twig,
        private ContentManagerInterface $manager,
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
            $page = $this->manager->getContent(Page::class, $slug);
        } catch (ContentNotFoundException $exception) {
            throw new NotFoundHttpException(\sprintf(
                'Page not found. Did you forget to create a `content/pages/%s.md` file?',
                $slug,
            ), $exception);
        }

        // You can create a custom template for each page, named after its slug,
        // (e.g: For "foo/bar.md" file => use "foo/bar.html.twig")
        // or use the generic "page.html.twig" one.
        $template = "pages/$slug.html.twig";
        if (!$this->twig->getLoader()->exists($template)) {
            $template = 'pages/page.html.twig';
        }

        return new Response($this->twig->render($template, ['page' => $page]));
    }
}

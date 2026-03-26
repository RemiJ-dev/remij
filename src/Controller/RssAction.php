<?php

declare(strict_types=1);

namespace App\Controller;

use App\Model\Article;
use Stenope\Bundle\ContentManagerInterface;
use Stenope\Bundle\Service\ContentUtils;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

readonly class RssAction
{
    public function __construct(
        private Environment $twig,
        private ContentManagerInterface $manager,
    ) {
    }

    /**
     * @throws RuntimeError
     * @throws SyntaxError
     * @throws LoaderError
     */
    #[Route(path: '/rss.xml', name: 'rss', methods: ['GET'])]
    public function __invoke(): Response
    {
        $articles = $this->manager->getContents(Article::class, ['publishedAt' => false], '_.isPublished()');

        /** @var ?\DateTimeInterface $lastModified */
        $lastModified = ContentUtils::max($articles, 'lastModifiedOrCreated');

        $content = $this->twig->render('rss/rss.xml.twig', [
            'articles' => $articles,
            'lastModified' => $lastModified,
        ]);

        $response = new Response($content)
            ->setLastModified($lastModified);

        $response->headers->set('Content-Type', 'application/atom+xml; charset=utf-8');

        return $response;
    }
}

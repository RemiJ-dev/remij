<?php

declare(strict_types=1);

namespace App\Controller\Article;

use App\Model\Article;
use Stenope\Bundle\ContentManagerInterface;
use Stenope\Bundle\Service\ContentUtils;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

readonly class ListAction
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
    #[Route('/articles/', name: 'article_list')]
    public function __invoke(): Response
    {
        $articles = $this->manager->getContents(Article::class, ['publishedAt' => false], '_.isPublished()');

        /** @var ?\DateTimeInterface $lastModified */
        $lastModified = ContentUtils::max($articles, 'lastModifiedOrCreated');

        return new Response($this->twig->render('articles/list.html.twig', [
            'articles' => $articles,
        ]))->setLastModified($lastModified);
    }
}

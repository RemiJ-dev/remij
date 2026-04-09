<?php

declare(strict_types=1);

namespace App\Controller\Article;

use App\Model\Article;
use App\Model\Author;
use Stenope\Bundle\ContentManagerInterface;
use Stenope\Bundle\Service\ContentUtils;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Attribute\Route;
use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

readonly class ListByAuthorAction
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
    #[Route('/articles/auteur/{slug}', name: 'article_list_by_author')]
    public function __invoke(string $slug): Response
    {
        $authors = $this->manager->getContents(
            type: Author::class,
            filterBy: '"' . $slug . '" === _.slug',
        );
        if ([] === $authors) {
            throw new NotFoundHttpException(\sprintf('Auteur "%s" introuvable.', $slug));
        }
        $author = reset($authors);

        $articles = $this->manager->getContents(Article::class, ['publishedAt' => false], '_.isPublished() and "' . $slug . '" in _.authors');

        /** @var ?\DateTimeInterface $lastModified */
        $lastModified = ContentUtils::max($articles, 'lastModifiedOrCreated');

        return new Response($this->twig->render('articles/list_by_author.html.twig', [
            'articles' => $articles,
            'author' => $author,
        ]))->setLastModified($lastModified);
    }
}

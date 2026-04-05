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

readonly class ListByTagAction
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
    #[Route('/articles/tag/{tag}', name: 'article_list_by_tag')]
    public function __invoke(string $tag): Response
    {
        $articles = $this->manager->getContents(Article::class, ['publishedAt' => false], '_.isPublished() and "' . $tag . '" in _.tags');

        /** @var ?\DateTimeInterface $lastModified */
        $lastModified = ContentUtils::max($articles, 'lastModifiedOrCreated');

        return new Response($this->twig->render('articles/list_by_tag.html.twig', [
            'articles' => $articles,
            'tag' => $tag,
        ]))->setLastModified($lastModified);
    }
}

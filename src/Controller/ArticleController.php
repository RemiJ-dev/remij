<?php

declare(strict_types=1);

namespace App\Controller;

use App\Model\Article;
use Stenope\Bundle\ContentManagerInterface;
use Stenope\Bundle\Service\ContentUtils;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/articles', name: 'article_')]
class ArticleController extends AbstractController
{
    public function __construct(private readonly ContentManagerInterface $manager)
    {
    }

    #[Route('/', name: 'list')]
    public function list(): Response
    {
        $articles = $this->manager->getContents(Article::class, ['publishedAt' => true], '_.isPublished()');

        return $this->render('articles/list.html.twig', [
            'articles' => $articles,
        ])->setLastModified(ContentUtils::max($articles, 'lastModifiedOrCreated'));
    }

    #[Route('/tag/{tag}', name: 'list_by_tag')]
    public function listByTag(string $tag): Response
    {
        $articles = $this->manager->getContents(Article::class, ['publishedAt' => true], '_.isPublished() and "'.$tag.'" in _.tags');
        return $this->render('articles/list_by_tag.html.twig', [
            'articles' => $articles,
            'tag' => $tag,
        ])->setLastModified(ContentUtils::max($articles, 'lastModifiedOrCreated'));
    }


    #[Route('/{article}', name: 'show', requirements: ['article' => '.+'])]
    public function show(Article $article): Response
    {
        return $this->render('articles/show.html.twig', [
            'article' => $article,
        ])->setLastModified($article->getLastModifiedOrCreated());
    }
}

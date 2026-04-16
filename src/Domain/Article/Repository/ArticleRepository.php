<?php

declare(strict_types=1);

namespace App\Domain\Article\Repository;

use App\Domain\Article\Model\Article;
use App\Domain\Article\Model\Author;
use Stenope\Bundle\ContentManagerInterface;

class ArticleRepository
{
    public const string CLASS_NAME = Article::class;

    public function __construct(
        private readonly ContentManagerInterface $manager,
    ) {
    }

    /**
     * @return array<string, Article>
     */
    public function findPublished(): array
    {
        return $this->manager->getContents(self::CLASS_NAME, ['publishedAt' => false], '_.isPublished()');
    }

    /**
     * @return array<string, Article>
     */
    public function findByTag(string $tag): array
    {
        return $this->manager->getContents(self::CLASS_NAME, ['publishedAt' => false], '_.isPublished() and "' . $tag . '" in _.tags');
    }

    /**
     * @return array<string, Article>
     */
    public function findByAuthor(Author $author): array
    {
        return $this->manager->getContents(self::CLASS_NAME, ['publishedAt' => false], '_.isPublished() and "' . $author->slug . '" in _.authors');
    }
}

<?php

declare(strict_types=1);

namespace App\Model;

use Stenope\Bundle\Attribute\SuggestedDebugQuery;
use Stenope\Bundle\Processor\TableOfContentProcessor;
use Stenope\Bundle\TableOfContent\TableOfContent;
use Symfony\Component\Serializer\Attribute\Context;
use Symfony\Component\Serializer\Normalizer\DateTimeNormalizer;

#[SuggestedDebugQuery('Scheduled', filters: 'not _.isPublished()', orders: 'desc:publishedAt')]
class Article
{
    use MetaTrait;

    public function __construct(
        public string $slug,
        public string $title,
        public ?string $description,
        public string $content,
        public ?string $nextArticle,
        /** @var array<int, string> $authors */
        public array $authors,
        /** @var array<int, string> $tags */
        public array $tags,
        #[Context([DateTimeNormalizer::FORMAT_KEY => 'Y-m-d'])]
        public \DateTimeInterface $publishedAt,
        public ?string $image = null,
        public ?\DateTimeInterface $lastModified = null,
        /** Automatically populated by {@link TableOfContentProcessor} */
        public ?TableOfContent $tableOfContent = null,
    ) {
    }

    public function getLastModifiedOrCreated(): \DateTimeInterface
    {
        return $this->lastModified ?? $this->publishedAt;
    }

    public function isPublished(): bool
    {
        return new \DateTimeImmutable() >= $this->publishedAt;
    }
}

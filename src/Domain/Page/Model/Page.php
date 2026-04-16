<?php

declare(strict_types=1);

namespace App\Domain\Page\Model;

use App\Domain\Seo\Model\MetaTrait;
use Symfony\Component\Serializer\Attribute\Context;
use Symfony\Component\Serializer\Normalizer\DateTimeNormalizer;

class Page
{
    use MetaTrait;

    public function __construct(
        public string $slug,
        public string $title,
        public string $content,
        #[Context([DateTimeNormalizer::FORMAT_KEY => 'Y-m-d'])]
        public \DateTimeInterface $publishedAt,
        public ?\DateTimeInterface $lastModified = null,
    ) {
    }
}

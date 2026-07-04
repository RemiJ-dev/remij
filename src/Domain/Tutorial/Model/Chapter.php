<?php

declare(strict_types=1);

namespace App\Domain\Tutorial\Model;

use App\Domain\Publication\Model\PublishableTrait;
use App\Domain\Seo\Model\MetaTrait;
use Stenope\Bundle\Attribute\SuggestedDebugQuery;
use Stenope\Bundle\Processor\TableOfContentProcessor;
use Stenope\Bundle\TableOfContent\TableOfContent;
use Symfony\Component\Serializer\Attribute\Context;
use Symfony\Component\Serializer\Normalizer\DateTimeNormalizer;

/**
 * A chapter of a tutorial series. Its slug is `<tutorial-slug>/<chapter-slug>`:
 * the parent directory of the content file is the tutorial it belongs to.
 * Tags and authors are carried by the tutorial, not by its chapters.
 */
#[SuggestedDebugQuery('Scheduled', filters: 'not _.isPublished()', orders: 'desc:publishedAt')]
class Chapter
{
    use MetaTrait;
    use PublishableTrait;

    public function __construct(
        public string $slug,
        public string $title,
        public ?string $description,
        public string $content,
        public int $position,
        #[Context([DateTimeNormalizer::FORMAT_KEY => 'Y-m-d'])]
        public \DateTimeInterface $publishedAt,
        public ?\DateTimeInterface $lastModified = null,
        /** Automatically populated by {@link TableOfContentProcessor} */
        public ?TableOfContent $tableOfContent = null,
    ) {
    }

    public function getTutorialSlug(): string
    {
        return \dirname($this->slug);
    }
}

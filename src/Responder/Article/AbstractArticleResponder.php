<?php

declare(strict_types=1);

namespace App\Responder\Article;

use App\Responder\AbstractTwigResponder;
use Stenope\Bundle\Service\ContentUtils;

abstract class AbstractArticleResponder extends AbstractTwigResponder
{
    /**
     * @param array<string, object> $articles
     */
    protected function lastModified(array $articles): ?\DateTimeInterface
    {
        if (0 === \count($articles)) {
            return null;
        }

        /** @var ?\DateTimeInterface $lastModified */
        $lastModified = ContentUtils::max($articles, 'lastModifiedOrCreated');

        return $lastModified;
    }
}

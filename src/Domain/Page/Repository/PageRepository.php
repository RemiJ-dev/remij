<?php

declare(strict_types=1);

namespace App\Domain\Page\Repository;

use App\Domain\Page\Model\Page;
use Stenope\Bundle\ContentManagerInterface;

class PageRepository
{
    public const string CLASS_NAME = Page::class;

    public function __construct(
        private readonly ContentManagerInterface $manager,
    ) {
    }

    public function findBySlug(string $slug): Page
    {
        return $this->manager->getContent(self::CLASS_NAME, $slug);
    }

    /**
     * @return array<string, Page>
     */
    public function findAll(): array
    {
        return $this->manager->getContents(self::CLASS_NAME);
    }
}

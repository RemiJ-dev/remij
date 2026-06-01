<?php

declare(strict_types=1);

namespace App\Domain\Page\Repository;

use App\Domain\Page\Model\Section;
use Stenope\Bundle\ContentManagerInterface;

class SectionRepository
{
    public const string CLASS_NAME = Section::class;

    public function __construct(
        private readonly ContentManagerInterface $manager,
    ) {
    }

    /** @return array<string, Section> */
    public function findByPage(string $slug): array
    {
        return $this->manager->getContents(self::CLASS_NAME, [
            'order' => true,
        ], [
            'page' => $slug,
        ]);
    }
}

<?php

declare(strict_types=1);

namespace App\Domain\Publication\Repository;

use App\Domain\Publication\Model\Author;
use Stenope\Bundle\ContentManagerInterface;

class AuthorRepository
{
    public const string CLASS_NAME = Author::class;

    public function __construct(
        private readonly ContentManagerInterface $manager,
    ) {
    }

    /**
     * @return array<string, Author>
     */
    public function findAll(): array
    {
        return $this->manager->getContents(self::CLASS_NAME, ['name' => true]);
    }
}

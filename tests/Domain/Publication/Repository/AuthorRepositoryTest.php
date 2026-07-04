<?php

declare(strict_types=1);

namespace App\Tests\Domain\Publication\Repository;

use App\Domain\Publication\Model\Author;
use App\Domain\Publication\Repository\AuthorRepository;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;
use Stenope\Bundle\ContentManagerInterface;

#[CoversClass(AuthorRepository::class)]
class AuthorRepositoryTest extends TestCase
{
    public function testFindAll(): void
    {
        $author = new Author(slug: 'remij', name: 'RémiJ');

        $manager = self::createMock(ContentManagerInterface::class);
        $manager->expects(self::once())
            ->method('getContents')
            ->with(Author::class, ['name' => true])
            ->willReturn(['remij' => $author]);

        $result = new AuthorRepository($manager)->findAll();

        self::assertSame(['remij' => $author], $result);
    }
}

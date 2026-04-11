<?php

declare(strict_types=1);

namespace App\Tests\Trello;

use App\Trello\Connection;
use App\Trello\ConnectionRepository;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Filesystem\Filesystem;

#[CoversClass(ConnectionRepository::class)]
class ConnectionRepositoryTest extends TestCase
{
    private string $tempDir;
    private ConnectionRepository $repository;

    protected function setUp(): void
    {
        $this->tempDir = sys_get_temp_dir() . '/trello_test_' . uniqid();
        $this->repository = new ConnectionRepository($this->tempDir, new Filesystem());
    }

    protected function tearDown(): void
    {
        new Filesystem()->remove($this->tempDir);
    }

    private function makeConnection(string $boardId = 'board123'): Connection
    {
        $now = new \DateTimeImmutable('2026-01-01T00:00:00+00:00');

        return new Connection(
            boardId: $boardId,
            boardName: 'Test Board',
            trelloWebhookId: 'webhook456',
            mattermostChannel: 'general',
            createdAt: $now,
            updatedAt: $now,
        );
    }

    public function testFindAllReturnsEmptyWhenNoStorageDir(): void
    {
        self::assertSame([], $this->repository->findAll());
    }

    /**
     * @throws \JsonException
     */
    public function testSaveAndFind(): void
    {
        $connection = $this->makeConnection();
        $this->repository->save($connection);

        $found = $this->repository->find('board123');
        self::assertNotNull($found);
        self::assertSame('board123', $found->boardId);
        self::assertSame('Test Board', $found->boardName);
        self::assertSame('general', $found->mattermostChannel);
        self::assertSame('webhook456', $found->trelloWebhookId);
    }

    public function testFindReturnsNullForUnknownBoard(): void
    {
        self::assertNull($this->repository->find('nonexistent'));
    }

    /**
     * @throws \JsonException
     */
    public function testFindAll(): void
    {
        $this->repository->save($this->makeConnection('board1'));
        $this->repository->save($this->makeConnection('board2'));

        $all = $this->repository->findAll();
        self::assertCount(2, $all);
        $ids = array_map(static fn (Connection $c): string => $c->boardId, $all);
        self::assertContains('board1', $ids);
        self::assertContains('board2', $ids);
    }

    /**
     * @throws \JsonException
     */
    public function testDelete(): void
    {
        $this->repository->save($this->makeConnection());
        $this->repository->delete('board123');

        self::assertNull($this->repository->find('board123'));
        self::assertSame([], $this->repository->findAll());
    }

    public function testDeleteNonExistentIsNoOp(): void
    {
        $this->repository->delete('nonexistent');
        self::assertSame([], $this->repository->findAll());
    }
}

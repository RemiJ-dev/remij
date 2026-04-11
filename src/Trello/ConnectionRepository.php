<?php

declare(strict_types=1);

namespace App\Trello;

use Symfony\Component\Filesystem\Filesystem;

final readonly class ConnectionRepository
{
    public function __construct(
        private string $storageDir,
        private Filesystem $filesystem,
    ) {
    }

    /** @return Connection[] */
    public function findAll(): array
    {
        if (!is_dir($this->storageDir)) {
            return [];
        }

        $connections = [];
        $files = glob($this->storageDir . '/*.json');
        foreach (false !== $files ? $files : [] as $file) {
            $connection = $this->readFile($file);
            if (null !== $connection) {
                $connections[] = $connection;
            }
        }

        return $connections;
    }

    public function find(string $boardId): ?Connection
    {
        $file = $this->filePath($boardId);
        if (!file_exists($file)) {
            return null;
        }

        return $this->readFile($file);
    }

    public function save(Connection $connection): void
    {
        $this->filesystem->mkdir($this->storageDir);
        $this->filesystem->dumpFile(
            $this->filePath($connection->boardId),
            json_encode($connection->toArray(), \JSON_PRETTY_PRINT | \JSON_THROW_ON_ERROR),
        );
    }

    public function delete(string $boardId): void
    {
        $file = $this->filePath($boardId);
        if (file_exists($file)) {
            $this->filesystem->remove($file);
        }
    }

    private function filePath(string $boardId): string
    {
        return $this->storageDir . '/' . $boardId . '.json';
    }

    private function readFile(string $file): ?Connection
    {
        $content = file_get_contents($file);
        if (false === $content) {
            return null;
        }

        try {
            /** @var array<string, mixed> $data */
            $data = json_decode($content, true, 512, \JSON_THROW_ON_ERROR);

            return Connection::fromArray($data);
        } catch (\JsonException|\InvalidArgumentException|\DateMalformedStringException) {
            return null;
        }
    }
}

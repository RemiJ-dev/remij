<?php

declare(strict_types=1);

namespace App\Tests\Domain\Planka\Repository;

use App\Domain\Planka\Repository\CardCounterRepository;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Filesystem\Filesystem;

#[CoversClass(CardCounterRepository::class)]
class CardCounterRepositoryTest extends TestCase
{
    private string $directory;

    protected function setUp(): void
    {
        $this->directory = sys_get_temp_dir() . '/planka-counter-' . bin2hex(random_bytes(4));
    }

    protected function tearDown(): void
    {
        new Filesystem()->remove($this->directory);
    }

    public function testNextStartsAtOneAndIncrementsPerProject(): void
    {
        $counter = new CardCounterRepository($this->directory . '/nested/counters.json');

        self::assertSame(1, $counter->next('project-a'));
        self::assertSame(2, $counter->next('project-a'));
        self::assertSame(1, $counter->next('project-b'));
        self::assertSame(2, $counter->current('project-a'));
    }

    public function testCounterIsPersistedAcrossInstances(): void
    {
        $path = $this->directory . '/counters.json';
        new CardCounterRepository($path)->next('project-a');
        new CardCounterRepository($path)->next('project-a');

        self::assertSame(3, new CardCounterRepository($path)->next('project-a'));
    }

    public function testFloorPreventsReusingANumberSeenInPlanka(): void
    {
        $counter = new CardCounterRepository($this->directory . '/counters.json');
        $counter->next('project-a');

        self::assertSame(11, $counter->next('project-a', 10));
        self::assertSame(12, $counter->next('project-a', 3));
    }

    public function testCurrentDoesNotReserveANumber(): void
    {
        $counter = new CardCounterRepository($this->directory . '/counters.json');

        self::assertSame(5, $counter->current('project-a', 5));
        self::assertSame(6, $counter->next('project-a', 5));
    }

    public function testCorruptedFileIsNotSilentlyReset(): void
    {
        mkdir($this->directory);
        file_put_contents($this->directory . '/counters.json', '{"project-a": "12"}');

        $this->expectException(\RuntimeException::class);

        new CardCounterRepository($this->directory . '/counters.json')->next('project-a');
    }
}

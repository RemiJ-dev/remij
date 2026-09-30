<?php

declare(strict_types=1);

namespace App\Tests\Domain\Planka\Model;

use App\Domain\Planka\Model\CardTitle;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

#[CoversClass(CardTitle::class)]
class CardTitleTest extends TestCase
{
    /**
     * @return iterable<string, array{string, ?int, string}>
     */
    public static function nameProvider(): iterable
    {
        yield 'plain title' => ['Corriger le flux RSS', null, 'Corriger le flux RSS'];
        yield 'numbered title' => ['#42 · Corriger le flux RSS', 42, 'Corriger le flux RSS'];
        yield 'numbered title without spaces' => ['#7·Titre', 7, 'Titre'];
        yield 'surrounding whitespace' => ['  #3 · Titre  ', 3, 'Titre'];
        yield 'hash without separator is not a number' => ['#42 Titre', null, '#42 Titre'];
        yield 'duplicated card keeps the copy suffix' => ['#42 · Titre (copie)', 42, 'Titre (copie)'];
    }

    #[DataProvider('nameProvider')]
    public function testFromName(string $name, ?int $expectedNumber, string $expectedText): void
    {
        $title = CardTitle::fromName($name);

        self::assertSame($expectedNumber, $title->number);
        self::assertSame($expectedText, $title->text);
    }

    public function testWithNumberReplacesAnExistingNumber(): void
    {
        self::assertSame('#43 · Titre', (string) CardTitle::fromName('#42 · Titre')->withNumber(43));
        self::assertSame('#1 · Titre', (string) CardTitle::fromName('Titre')->withNumber(1));
    }

    public function testUnnumberedTitleIsRenderedAsIs(): void
    {
        self::assertSame('Titre', (string) CardTitle::fromName('Titre'));
    }
}

<?php

declare(strict_types=1);

namespace App\Tests\Domain\Page\DTO;

use App\Domain\Page\DTO\ContactDTO;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

#[CoversClass(ContactDTO::class)]
class ContactDTOTest extends TestCase
{
    /** @return iterable<string, array{string}> */
    public static function validCaptchaProvider(): iterable
    {
        $month = (int) (new \DateTimeImmutable())->format('n');
        $paddedMonth = \sprintf('%02d', $month);
        $frenchMonths = [
            1 => 'janvier', 2 => 'février', 3 => 'mars', 4 => 'avril',
            5 => 'mai', 6 => 'juin', 7 => 'juillet', 8 => 'août',
            9 => 'septembre', 10 => 'octobre', 11 => 'novembre', 12 => 'décembre',
        ];

        yield 'numéro du mois sans zéro' => [(string) $month];
        yield 'numéro du mois avec zéro' => [$paddedMonth];
        yield 'nom du mois en minuscules' => [$frenchMonths[$month]];
        yield 'nom du mois en majuscules' => [mb_strtoupper($frenchMonths[$month])];
        yield 'nom du mois avec espaces' => ['  ' . $frenchMonths[$month] . '  '];
    }

    /** @return iterable<string, array{string}> */
    public static function invalidCaptchaProvider(): iterable
    {
        yield 'chaîne vide' => [''];
        yield 'mauvais mois' => ['99'];
        yield 'texte aléatoire' => ['mauvaisMois'];
    }

    #[DataProvider('validCaptchaProvider')]
    public function testCaptchaIsValid(string $captcha): void
    {
        $dto = new ContactDTO();
        $dto->captcha = $captcha;

        self::assertTrue($dto->isCaptchaValid());
    }

    #[DataProvider('invalidCaptchaProvider')]
    public function testCaptchaIsInvalid(string $captcha): void
    {
        $dto = new ContactDTO();
        $dto->captcha = $captcha;

        self::assertFalse($dto->isCaptchaValid());
    }
}

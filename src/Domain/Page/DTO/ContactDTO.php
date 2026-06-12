<?php

declare(strict_types=1);

namespace App\Domain\Page\DTO;

use Symfony\Component\Validator\Constraints as Assert;

class ContactDTO
{
    #[Assert\NotBlank]
    #[Assert\Length(max: 100)]
    public string $name = '';

    #[Assert\NotBlank]
    #[Assert\Email]
    public string $email = '';

    #[Assert\NotBlank]
    #[Assert\Length(max: 200)]
    public string $subject = '';

    #[Assert\NotBlank]
    #[Assert\Length(max: 5000)]
    public string $message = '';

    #[Assert\NotBlank]
    public ?string $captcha = null;

    private const array FRENCH_MONTHS = [
        1 => 'janvier',
        2 => 'février',
        3 => 'mars',
        4 => 'avril',
        5 => 'mai',
        6 => 'juin',
        7 => 'juillet',
        8 => 'août',
        9 => 'septembre',
        10 => 'octobre',
        11 => 'novembre',
        12 => 'décembre',
    ];

    #[Assert\IsTrue(message: 'contact.form.error.captcha')]
    public function isCaptchaValid(): bool
    {
        if (null === $this->captcha) {
            return false;
        }

        $month = (int) new \DateTimeImmutable()->format('n');
        $captcha = mb_strtolower(trim($this->captcha));

        return $captcha === (string) $month
            || $captcha === \sprintf('%02d', $month)
            || $captcha === self::FRENCH_MONTHS[$month];
    }
}

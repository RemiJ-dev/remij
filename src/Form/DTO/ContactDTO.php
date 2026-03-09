<?php

declare(strict_types=1);

namespace App\Form\DTO;

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
}

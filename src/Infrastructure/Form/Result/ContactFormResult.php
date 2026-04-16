<?php

declare(strict_types=1);

namespace App\Infrastructure\Form\Result;

use App\Domain\Contact\DTO\ContactDTO;
use Symfony\Component\Form\FormInterface;

readonly class ContactFormResult
{
    /**
     * @param FormInterface<ContactDTO> $form
     */
    public function __construct(
        public FormInterface $form,
        public bool $sent,
    ) {
    }
}

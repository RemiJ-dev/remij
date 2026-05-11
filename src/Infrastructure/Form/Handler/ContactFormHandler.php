<?php

declare(strict_types=1);

namespace App\Infrastructure\Form\Handler;

use App\Domain\Page\DTO\ContactDTO;
use App\Infrastructure\Form\ContactType;
use App\Infrastructure\Form\Result\ContactFormResult;
use App\Infrastructure\Mailer\ContactMailer;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;

readonly class ContactFormHandler
{
    public function __construct(
        private FormFactoryInterface $formFactory,
        private ContactMailer $mailer,
    ) {
    }

    /**
     * @throws TransportExceptionInterface
     */
    public function handle(Request $request): ContactFormResult
    {
        $data = new ContactDTO();
        $form = $this->formFactory->create(ContactType::class, $data);
        $form->handleRequest($request);
        $sent = false;
        $success = false;

        if ($form->isSubmitted()) {
            $sent = true;

            if ($form->isValid()) {
                $this->mailer->send($data);
                $success = true;
            }
        }

        return new ContactFormResult(form: $form, sent: $sent, success: $success);
    }
}

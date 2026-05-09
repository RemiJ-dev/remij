<?php

declare(strict_types=1);

namespace App\Infrastructure\Mailer;

use App\Domain\Page\DTO\ContactDTO;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Contracts\Translation\TranslatorInterface;

readonly class ContactMailer
{
    public function __construct(
        private MailerInterface $mailer,
        private TranslatorInterface $translator,
    ) {
    }

    /**
     * @throws TransportExceptionInterface
     */
    public function send(ContactDTO $data): void
    {
        $email = new Email()
            ->from('contact@remij.dev')
            ->to('bonjour@remij.dev')
            ->replyTo($data->email)
            ->subject($this->translator->trans('contact.email.subject', ['subject' => $data->subject]))
            ->text($this->translator->trans('contact.email.body', ['name' => $data->name, 'email' => $data->email, 'message' => $data->message]));

        $this->mailer->send($email);
    }
}

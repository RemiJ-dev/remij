<?php

declare(strict_types=1);

namespace App\Tests\Infrastructure\Mailer;

use App\Domain\Page\DTO\ContactDTO;
use App\Infrastructure\Mailer\ContactMailer;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Contracts\Translation\TranslatorInterface;

#[CoversClass(ContactMailer::class)]
class ContactMailerTest extends TestCase
{
    /**
     * @throws TransportExceptionInterface
     */
    public function testSendBuildsAndSendsEmailFromDto(): void
    {
        $translator = self::createStub(TranslatorInterface::class);
        $translator->method('trans')->willReturnArgument(0);

        $mailer = $this->createMock(MailerInterface::class);
        $mailer
            ->expects($this->once())
            ->method('send')
            ->with(self::callback(function (Email $email): bool {
                return 'contact@remij.dev' === $email->getFrom()[0]->getAddress()
                    && 'bonjour@remij.dev' === $email->getTo()[0]->getAddress()
                    && 'test@ouille.test' === $email->getReplyTo()[0]->getAddress();
            }));

        $data = new ContactDTO();
        $data->name = 'Test Ouille';
        $data->email = 'test@ouille.test';
        $data->subject = 'Hello';
        $data->message = 'World';

        new ContactMailer($mailer, $translator)->send($data);
    }
}

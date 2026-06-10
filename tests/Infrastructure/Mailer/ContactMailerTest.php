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

        /** @var list<Email> $sent */
        $sent = [];
        $mailer = self::createMock(MailerInterface::class);
        $mailer
            ->expects(self::exactly(2))
            ->method('send')
            ->willReturnCallback(function (Email $email) use (&$sent): void {
                $sent[] = $email;
            });

        $data = new ContactDTO();
        $data->name = 'Test Ouille';
        $data->email = 'test@ouille.test';
        $data->subject = 'Hello';
        $data->message = 'World';

        new ContactMailer($mailer, $translator)->send($data);

        // First email: notification to the site owner, reply-to the sender.
        self::assertSame('contact@remij.dev', $sent[0]->getFrom()[0]->getAddress());
        self::assertSame('bonjour@remij.dev', $sent[0]->getTo()[0]->getAddress());
        self::assertSame('test@ouille.test', $sent[0]->getReplyTo()[0]->getAddress());

        // Second email: acknowledgement sent back to the visitor.
        self::assertSame('bonjour@remij.dev', $sent[1]->getFrom()[0]->getAddress());
        self::assertSame('test@ouille.test', $sent[1]->getTo()[0]->getAddress());
    }
}

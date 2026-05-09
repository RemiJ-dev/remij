<?php

declare(strict_types=1);

namespace App\Tests\Infrastructure\Form;

use App\Infrastructure\Form\Handler\ContactFormHandler;
use App\Infrastructure\Form\Result\ContactFormResult;
use App\Infrastructure\Mailer\ContactMailer;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;

#[CoversClass(ContactFormHandler::class)]
class ContactFormHandlerTest extends TestCase
{
    /**
     * @throws TransportExceptionInterface
     */
    public function testHandleReturnsNotSentWhenFormIsNotSubmitted(): void
    {
        $form = self::createStub(FormInterface::class);
        $form->method('isSubmitted')->willReturn(false);

        $formFactory = self::createStub(FormFactoryInterface::class);
        $formFactory->method('create')->willReturn($form);

        $mailer = $this->createMock(ContactMailer::class);
        $mailer->expects($this->never())->method('send');

        $result = new ContactFormHandler($formFactory, $mailer)->handle(new Request());

        self::assertInstanceOf(ContactFormResult::class, $result);
        self::assertFalse($result->sent);
    }

    public function testHandleReturnsNotSentWhenFormIsInvalid(): void
    {
        $form = self::createStub(FormInterface::class);
        $form->method('isSubmitted')->willReturn(true);
        $form->method('isValid')->willReturn(false);

        $formFactory = self::createStub(FormFactoryInterface::class);
        $formFactory->method('create')->willReturn($form);

        $mailer = $this->createMock(ContactMailer::class);
        $mailer->expects($this->never())->method('send');

        $result = new ContactFormHandler($formFactory, $mailer)->handle(new Request());

        self::assertFalse($result->sent);
    }

    public function testHandleSendsEmailAndReturnsSentWhenFormIsValid(): void
    {
        $form = self::createStub(FormInterface::class);
        $form->method('isSubmitted')->willReturn(true);
        $form->method('isValid')->willReturn(true);

        $formFactory = self::createStub(FormFactoryInterface::class);
        $formFactory->method('create')->willReturn($form);

        $mailer = $this->createMock(ContactMailer::class);
        $mailer->expects($this->once())->method('send');

        $result = new ContactFormHandler($formFactory, $mailer)->handle(new Request());

        self::assertTrue($result->sent);
    }
}

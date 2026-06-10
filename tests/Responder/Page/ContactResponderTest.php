<?php

declare(strict_types=1);

namespace App\Tests\Responder\Page;

use App\Domain\Page\Model\Page;
use App\Infrastructure\Form\Handler\ContactFormHandler;
use App\Infrastructure\Form\Result\ContactFormResult;
use App\Responder\Page\ContactResponder;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Contracts\Translation\TranslatorInterface;

#[CoversClass(ContactResponder::class)]
class ContactResponderTest extends TestCase
{
    public function testRespondRendersFormWhenNotSubmitted(): void
    {
        $renderCalled = 0;
        $render = function (string $template, array $parameters, ?Response $response = null) use (&$renderCalled): Response {
            ++$renderCalled;
            $response ??= new Response();
            self::assertSame('pages/contact.html.twig', $template);
            self::assertArrayHasKey('page', $parameters);
            self::assertArrayHasKey('form', $parameters);
            self::assertSame(Response::HTTP_OK, $response->getStatusCode());

            return $response->setContent('<html>contact</html>');
        };

        $responder = new ContactResponder(
            static fn () => null,
            static fn (): RedirectResponse => new RedirectResponse('/contact'),
            $render,
            self::createStub(TranslatorInterface::class),
            $this->formHandler(sent: false, success: false),
        );

        $response = $responder->respond($this->page(), new Request());

        self::assertSame(1, $renderCalled);
        self::assertSame(Response::HTTP_OK, $response->getStatusCode());
        self::assertSame('<html>contact</html>', $response->getContent());
    }

    public function testRespondRedirectsWithFlashWhenSubmissionSucceeds(): void
    {
        $flashed = [];
        $addFlash = function (string $type, string $message) use (&$flashed): void {
            $flashed[] = [$type, $message];
        };

        $redirectedTo = null;
        $redirectToRoute = function (string $route) use (&$redirectedTo): RedirectResponse {
            $redirectedTo = $route;

            return new RedirectResponse('/contact');
        };

        $translator = self::createStub(TranslatorInterface::class);
        $translator->method('trans')->willReturn('Message envoyé !');

        $render = static fn (): Response => self::fail('render() must not be called on success');

        $responder = new ContactResponder(
            $addFlash,
            $redirectToRoute,
            $render,
            $translator,
            $this->formHandler(sent: true, success: true),
        );

        $response = $responder->respond($this->page(), new Request());

        self::assertInstanceOf(RedirectResponse::class, $response);
        self::assertSame('page_contact', $redirectedTo);
        self::assertSame([['success', 'Message envoyé !']], $flashed);
    }

    public function testRespondRendersUnprocessableWhenSubmissionFails(): void
    {
        $capturedStatus = null;
        $render = function (string $template, array $parameters, ?Response $response = null) use (&$capturedStatus): Response {
            $response ??= new Response();
            $capturedStatus = $response->getStatusCode();
            self::assertSame('pages/contact.html.twig', $template);

            return $response->setContent('<html>errors</html>');
        };

        $responder = new ContactResponder(
            static fn () => null,
            static fn (): RedirectResponse => new RedirectResponse('/contact'),
            $render,
            self::createStub(TranslatorInterface::class),
            $this->formHandler(sent: true, success: false),
        );

        $response = $responder->respond($this->page(), new Request());

        self::assertSame(Response::HTTP_UNPROCESSABLE_ENTITY, $capturedStatus);
        self::assertSame(Response::HTTP_UNPROCESSABLE_ENTITY, $response->getStatusCode());
    }

    private function page(): Page
    {
        return new Page(slug: 'contact', title: 'Contact', content: '', publishedAt: new \DateTimeImmutable());
    }

    private function formHandler(bool $sent, bool $success): ContactFormHandler
    {
        $form = self::createStub(FormInterface::class);
        $form->method('createView')->willReturn(new FormView());

        $handler = self::createStub(ContactFormHandler::class);
        $handler->method('handle')->willReturn(new ContactFormResult(form: $form, sent: $sent, success: $success));

        return $handler;
    }
}

<?php

declare(strict_types=1);

namespace App\Tests\Responder\Page;

use App\Domain\Page\Model\Page;
use App\Responder\Page\ContactResponder;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Response;

#[CoversClass(ContactResponder::class)]
class ContactResponderTest extends TestCase
{
    public function testInvokeRendersExpectedTemplate(): void
    {
        $renderCalled = 0;
        $render = function (string $template, array $parameters) use (&$renderCalled): Response {
            ++$renderCalled;
            self::assertSame('pages/contact.html.twig', $template);
            self::assertArrayHasKey('page', $parameters);
            self::assertArrayHasKey('form', $parameters);

            return new Response('<html>contact</html>');
        };

        $page = new Page(slug: 'contact', title: 'Contact', content: '', publishedAt: new \DateTimeImmutable());
        $form = self::createStub(FormInterface::class);

        $response = new ContactResponder($render)($page, $form);

        self::assertSame(1, $renderCalled);
        self::assertInstanceOf(Response::class, $response);
        self::assertSame('<html>contact</html>', $response->getContent());
    }
}

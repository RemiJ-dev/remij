<?php

declare(strict_types=1);

namespace App\Tests\Responder\Page;

use App\Domain\Page\Model\Page;
use App\Responder\Page\ContactResponder;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;

#[CoversClass(ContactResponder::class)]
class ContactResponderTest extends TestCase
{
    public function testInvokeRendersExpectedTemplate(): void
    {
        $twig = $this->createMock(Environment::class);
        $twig
            ->expects($this->once())
            ->method('render')
            ->with(
                'pages/contact.html.twig',
                self::callback(fn (array $context): bool => isset($context['page'], $context['form']))
            )
            ->willReturn('<html>contact</html>');

        $page = new Page(slug: 'contact', title: 'Contact', content: '', publishedAt: new \DateTimeImmutable());
        $form = self::createStub(FormInterface::class);

        $response = (new ContactResponder($twig))($page, $form);

        self::assertInstanceOf(Response::class, $response);
        self::assertSame('<html>contact</html>', $response->getContent());
    }
}

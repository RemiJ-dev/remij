<?php

declare(strict_types=1);

namespace App\Tests\Responder\Page;

use App\Responder\Page\HomeResponder;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;

#[CoversClass(HomeResponder::class)]
class HomeResponderTest extends TestCase
{
    public function testInvokeRendersExpectedTemplate(): void
    {
        $twig = $this->createMock(Environment::class);
        $twig
            ->expects($this->once())
            ->method('render')
            ->with('pages/home.html.twig', [])
            ->willReturn('<html>home</html>');

        $response = (new HomeResponder($twig))();

        self::assertInstanceOf(Response::class, $response);
        self::assertSame('<html>home</html>', $response->getContent());
    }
}

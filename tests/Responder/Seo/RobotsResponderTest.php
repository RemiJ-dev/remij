<?php

declare(strict_types=1);

namespace App\Tests\Responder\Seo;

use App\Responder\Seo\RobotsResponder;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;

#[CoversClass(RobotsResponder::class)]
class RobotsResponderTest extends TestCase
{
    public function testInvokeRendersExpectedTemplateWithTextPlainContentType(): void
    {
        $twig = $this->createMock(Environment::class);
        $twig
            ->expects($this->once())
            ->method('render')
            ->with('seo/robots.txt.twig', [])
            ->willReturn('User-agent: *');

        $response = (new RobotsResponder($twig))();

        self::assertInstanceOf(Response::class, $response);
        self::assertSame('User-agent: *', $response->getContent());
        self::assertSame('text/plain', $response->headers->get('Content-Type'));
    }
}

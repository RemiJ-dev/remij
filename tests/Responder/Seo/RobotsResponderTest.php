<?php

declare(strict_types=1);

namespace App\Tests\Responder\Seo;

use App\Responder\Seo\RobotsResponder;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Response;

#[CoversClass(RobotsResponder::class)]
class RobotsResponderTest extends TestCase
{
    public function testInvokeRendersExpectedTemplateWithTextPlainContentType(): void
    {
        $renderCalled = 0;
        $render = function (string $template, array $parameters) use (&$renderCalled): Response {
            ++$renderCalled;
            self::assertSame('seo/robots.txt.twig', $template);
            self::assertSame([], $parameters);

            return new Response('User-agent: *');
        };

        $response = new RobotsResponder($render)();

        self::assertSame(1, $renderCalled);
        self::assertInstanceOf(Response::class, $response);
        self::assertSame('User-agent: *', $response->getContent());
        self::assertSame('text/plain', $response->headers->get('Content-Type'));
    }
}

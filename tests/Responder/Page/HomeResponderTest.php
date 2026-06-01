<?php

declare(strict_types=1);

namespace App\Tests\Responder\Page;

use App\Responder\Page\HomeResponder;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Response;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

#[CoversClass(HomeResponder::class)]
class HomeResponderTest extends TestCase
{
    /**
     * @throws SyntaxError
     * @throws RuntimeError
     * @throws LoaderError
     */
    public function testInvokeRendersExpectedTemplate(): void
    {
        $renderCalled = 0;
        $render = function (string $template, array $parameters) use (&$renderCalled): Response {
            ++$renderCalled;
            self::assertSame('pages/home.html.twig', $template);
            self::assertSame(['sections' => []], $parameters);

            return new Response('<html>home</html>');
        };

        $response = new HomeResponder($render)([]);

        self::assertSame(1, $renderCalled);
        self::assertInstanceOf(Response::class, $response);
        self::assertSame('<html>home</html>', $response->getContent());
    }
}

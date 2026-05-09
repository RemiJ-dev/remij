<?php

declare(strict_types=1);

namespace App\Tests\Responder\Page;

use App\Domain\Page\Model\Page;
use App\Responder\Page\ContentResponder;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;
use Twig\Loader\LoaderInterface;

#[CoversClass(ContentResponder::class)]
class ContentResponderTest extends TestCase
{
    public function testInvokeRendersCustomTemplateWhenItExists(): void
    {
        $loader = self::createStub(LoaderInterface::class);
        $loader->method('exists')->willReturn(true);

        $twig = self::createStub(Environment::class);
        $twig->method('getLoader')->willReturn($loader);

        $renderCalled = 0;
        $render = function (string $template, array $parameters) use (&$renderCalled): Response {
            ++$renderCalled;
            self::assertSame('pages/about.html.twig', $template);
            self::assertArrayHasKey('page', $parameters);

            return new Response('<html>about custom</html>');
        };

        $page = new Page(slug: 'about', title: 'About', content: '', publishedAt: new \DateTimeImmutable());

        $response = new ContentResponder($render, $twig)('about', $page);

        self::assertSame(1, $renderCalled);
        self::assertInstanceOf(Response::class, $response);
        self::assertSame('<html>about custom</html>', $response->getContent());
    }

    public function testInvokeFallsBackToGenericTemplateWhenCustomDoesNotExist(): void
    {
        $loader = self::createStub(LoaderInterface::class);
        $loader->method('exists')->willReturn(false);

        $twig = self::createStub(Environment::class);
        $twig->method('getLoader')->willReturn($loader);

        $renderCalled = 0;
        $render = function (string $template, array $parameters) use (&$renderCalled): Response {
            ++$renderCalled;
            self::assertSame('pages/page.html.twig', $template);
            self::assertArrayHasKey('page', $parameters);

            return new Response('<html>generic</html>');
        };

        $page = new Page(slug: 'unknown', title: 'Unknown', content: '', publishedAt: new \DateTimeImmutable());

        $response = new ContentResponder($render, $twig)('unknown', $page);

        self::assertSame(1, $renderCalled);
        self::assertSame('<html>generic</html>', $response->getContent());
    }
}

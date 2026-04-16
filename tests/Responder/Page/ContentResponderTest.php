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

        $twig = $this->createMock(Environment::class);
        $twig->method('getLoader')->willReturn($loader);
        $twig
            ->expects($this->once())
            ->method('render')
            ->with('pages/about.html.twig', self::callback(fn (array $c): bool => isset($c['page'])))
            ->willReturn('<html>about custom</html>');

        $page = new Page(slug: 'about', title: 'About', content: '', publishedAt: new \DateTimeImmutable());

        $response = (new ContentResponder($twig))('about', $page);

        self::assertInstanceOf(Response::class, $response);
        self::assertSame('<html>about custom</html>', $response->getContent());
    }

    public function testInvokeFallsBackToGenericTemplateWhenCustomDoesNotExist(): void
    {
        $loader = self::createStub(LoaderInterface::class);
        $loader->method('exists')->willReturn(false);

        $twig = $this->createMock(Environment::class);
        $twig->method('getLoader')->willReturn($loader);
        $twig
            ->expects($this->once())
            ->method('render')
            ->with('pages/page.html.twig', self::callback(fn (array $c): bool => isset($c['page'])))
            ->willReturn('<html>generic</html>');

        $page = new Page(slug: 'unknown', title: 'Unknown', content: '', publishedAt: new \DateTimeImmutable());

        $response = (new ContentResponder($twig))('unknown', $page);

        self::assertSame('<html>generic</html>', $response->getContent());
    }
}

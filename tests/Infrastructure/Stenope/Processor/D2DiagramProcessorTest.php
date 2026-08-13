<?php

declare(strict_types=1);

namespace App\Tests\Infrastructure\Stenope\Processor;

use App\Infrastructure\Stenope\Processor\D2DiagramProcessor;
use PHPUnit\Framework\TestCase;
use Stenope\Bundle\Content;
use Stenope\Bundle\Service\NaiveHtmlCrawlerManager;
use Symfony\Component\AssetMapper\AssetMapperInterface;
use Symfony\Component\AssetMapper\MappedAsset;
use Symfony\Component\Filesystem\Filesystem;

class D2DiagramProcessorTest extends TestCase
{
    /**
     * SVG minimal reproduisant la structure émise par `d2 --dark-theme` :
     * un marqueur de version, et des règles sombres scopées dans une media query.
     */
    private const D2_SVG = '<?xml version="1.0" encoding="utf-8"?>'
        . '<svg xmlns="http://www.w3.org/2000/svg" data-d2-version="v0.7.1" viewBox="0 0 10 10">'
        . '<style type="text/css">.d2-1 .fill-N7{fill:#FFFFFF;}'
        . '@media screen and (prefers-color-scheme:dark){.d2-1 .fill-N7{fill:#1E1E2E;}.d2-1 .fill-N1{fill:#CDD6F4;}}'
        . '</style><rect class="fill-N7"/></svg>';

    private string $directory;
    private Filesystem $filesystem;

    protected function setUp(): void
    {
        $this->filesystem = new Filesystem();
        $this->directory = sys_get_temp_dir() . '/d2-diagram-processor-' . uniqid();
        $this->filesystem->mkdir($this->directory);
    }

    protected function tearDown(): void
    {
        $this->filesystem->remove($this->directory);
    }

    public function testItInlinesADiagramAndDropsTheImageTag(): void
    {
        $content = $this->process('diagram.svg', self::D2_SVG, '<p><img src="diagram.svg" alt="Un schéma"></p>');

        self::assertStringNotContainsString('<img', $content);
        self::assertStringContainsString('data-d2-version="v0.7.1"', $content);
    }

    public function testItBindsDarkRulesToTheSiteTheme(): void
    {
        $content = $this->process('diagram.svg', self::D2_SVG, '<p><img src="diagram.svg" alt="Un schéma"></p>');

        // Les règles sombres répondent désormais au thème choisi sur le site…
        self::assertStringContainsString('[data-bs-theme="dark"] .d2-1 .fill-N7{fill:#1E1E2E;}', $content);
        self::assertStringContainsString('[data-bs-theme="dark"] .d2-1 .fill-N1{fill:#CDD6F4;}', $content);

        // … tout en restant neutralisées lorsque le visiteur force le thème clair.
        self::assertStringContainsString(
            ':root:not([data-bs-theme="light"]) .d2-1 .fill-N7{fill:#1E1E2E;}',
            $content,
        );
    }

    public function testItKeepsTheStyleSheetBalanced(): void
    {
        $content = $this->process('diagram.svg', self::D2_SVG, '<p><img src="diagram.svg" alt="Un schéma"></p>');

        self::assertSame(
            substr_count($content, '{'),
            substr_count($content, '}'),
            'Le CSS réécrit doit rester équilibré en accolades.',
        );
    }

    public function testItCarriesTheAlternativeTextOverToTheSvg(): void
    {
        $content = $this->process('diagram.svg', self::D2_SVG, '<p><img src="diagram.svg" alt="Un schéma"></p>');

        self::assertStringContainsString('role="img"', $content);
        self::assertStringContainsString('aria-label="Un schéma"', $content);
    }

    public function testItHidesADiagramWithoutAlternativeText(): void
    {
        $content = $this->process('diagram.svg', self::D2_SVG, '<p><img src="diagram.svg" alt=""></p>');

        self::assertStringContainsString('aria-hidden="true"', $content);
        self::assertStringNotContainsString('role="img"', $content);
    }

    public function testItLeavesSvgFilesNotProducedByD2Untouched(): void
    {
        $svg = '<?xml version="1.0" encoding="utf-8"?><svg xmlns="http://www.w3.org/2000/svg"><rect/></svg>';

        $content = $this->process('logo.svg', $svg, '<p><img src="logo.svg" alt="Logo"></p>');

        self::assertStringContainsString('<img src="logo.svg"', $content);
    }

    public function testItLeavesNonSvgImagesUntouched(): void
    {
        $content = $this->process('diagram.svg', self::D2_SVG, '<p><img src="photo.png" alt="Photo"></p>');

        self::assertStringContainsString('<img src="photo.png"', $content);
    }

    public function testItLeavesUnknownAssetsUntouched(): void
    {
        $content = $this->process('diagram.svg', self::D2_SVG, '<p><img src="inconnu.svg" alt="Inconnu"></p>');

        self::assertStringContainsString('<img src="inconnu.svg"', $content);
    }

    public function testItIgnoresContentWithoutTheConfiguredProperty(): void
    {
        $processor = new D2DiagramProcessor(
            self::createStub(AssetMapperInterface::class),
            new NaiveHtmlCrawlerManager(),
        );

        $data = ['title' => 'Sans contenu'];
        $processor($data, $this->content());

        self::assertSame(['title' => 'Sans contenu'], $data);
    }

    /**
     * Exécute le processor sur $html, avec un unique asset $logicalPath dont le
     * fichier source contient $svg.
     */
    private function process(string $logicalPath, string $svg, string $html): string
    {
        $sourcePath = $this->directory . '/' . $logicalPath;
        $this->filesystem->dumpFile($sourcePath, $svg);

        $assetMapper = self::createStub(AssetMapperInterface::class);
        $assetMapper->method('getAsset')->willReturnCallback(
            static fn (string $requested): ?MappedAsset => $requested === $logicalPath
                ? new MappedAsset($logicalPath, $sourcePath)
                : null,
        );

        $processor = new D2DiagramProcessor($assetMapper, new NaiveHtmlCrawlerManager());

        $data = ['content' => $html];
        // Appel explicite plutôt que `$processor(...)` : PHPStan ne suit le type
        // du paramètre passé par référence que sur un appel de méthode résolu.
        $processor->__invoke($data, $this->content());

        $processed = $data['content'] ?? null;

        if (!\is_string($processed)) {
            self::fail('Le processor doit laisser une chaîne dans la propriété traitée.');
        }

        return $processed;
    }

    private function content(): Content
    {
        return new Content('un-article', 'articles', '', 'html');
    }
}

<?php

declare(strict_types=1);

namespace App\Tests\Infrastructure\Stenope\Processor;

use App\Infrastructure\Stenope\Processor\D2DiagramProcessor;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;
use Stenope\Bundle\Content;
use Stenope\Bundle\Service\NaiveHtmlCrawlerManager;
use Symfony\Component\AssetMapper\AssetMapperInterface;
use Symfony\Component\AssetMapper\MappedAsset;
use Symfony\Component\Filesystem\Filesystem;

class D2DiagramProcessorTest extends TestCase
{
    /** Scope appliqué à toutes les règles du diagramme. */
    private const SCOPE = 'svg[data-d2-version]';

    /**
     * SVG minimal reproduisant la structure émise par `d2 --dark-theme` : deux
     * éléments `<style>` en CDATA — les polices d'un côté, les couleurs de l'autre —
     * mêlant des règles scopées par D2 (`.d2-1 …`) et des règles qu'il laisse nues
     * (`.shape`, `.blend`), plus une media query sombre.
     */
    private const D2_SVG = '<?xml version="1.0" encoding="utf-8"?>'
        . '<svg xmlns="http://www.w3.org/2000/svg" data-d2-version="v0.7.1" viewBox="0 0 10 10">'
        . '<style type="text/css"><![CDATA[.d2-1 .text{font-family:"d2-1-font-regular";}'
        . '@font-face{font-family:d2-1-font-regular;src:url("data:application/font-woff;base64,AAAA");}'
        . ']]></style>'
        . '<style type="text/css"><![CDATA[.shape{shape-rendering:geometricPrecision;}'
        . '.blend{mix-blend-mode:multiply;opacity:0.5;}'
        . '.d2-1 .fill-N7{fill:#FFFFFF;}'
        . '@media screen and (prefers-color-scheme:dark){.shape{stroke:#000000;}.d2-1 .fill-N7{fill:#1E1E2E;}}'
        . ']]></style><rect class="fill-N7"/></svg>';

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

    /**
     * Le cœur du problème : inliner fait perdre au SVG l'isolation de son document.
     * Toute règle laissée nue par D2 s'appliquerait à la page entière.
     *
     * @param string $selector sélecteur que D2 n'a pas qualifié
     */
    #[DataProvider('provideUnqualifiedSelectors')]
    public function testItScopesRulesLeftUnqualifiedByD2(string $selector): void
    {
        $content = $this->process('diagram.svg', self::D2_SVG, '<p><img src="diagram.svg" alt="Un schéma"></p>');

        self::assertStringContainsString(\sprintf('%s %s{', self::SCOPE, $selector), $content);

        // Chaque occurrence doit être précédée du scope : aucune ne fuit dans la page.
        self::assertSame(
            substr_count($content, \sprintf('%s{', $selector)),
            substr_count($content, \sprintf('%s %s{', self::SCOPE, $selector)),
            \sprintf('Toute règle `%s` doit être scopée sur la racine du diagramme.', $selector),
        );
    }

    /**
     * @return iterable<string, array{string}>
     */
    public static function provideUnqualifiedSelectors(): iterable
    {
        yield '.shape' => ['.shape'];
        yield '.blend' => ['.blend'];
    }

    public function testItAlsoScopesRulesAlreadyQualifiedByD2(): void
    {
        $content = $this->process('diagram.svg', self::D2_SVG, '<p><img src="diagram.svg" alt="Un schéma"></p>');

        self::assertStringContainsString(self::SCOPE . ' .d2-1 .fill-N7{fill:#FFFFFF;}', $content);
    }

    public function testItLeavesFontFaceRulesUntouched(): void
    {
        $content = $this->process('diagram.svg', self::D2_SVG, '<p><img src="diagram.svg" alt="Un schéma"></p>');

        // Préfixer une at-rule produirait une règle que les navigateurs jettent :
        // les polices du diagramme disparaîtraient sans la moindre erreur.
        self::assertStringContainsString('@font-face{font-family:d2-1-font-regular;', $content);
        self::assertStringNotContainsString(self::SCOPE . ' @font-face', $content);
    }

    public function testItBindsDarkRulesToTheSiteTheme(): void
    {
        $content = $this->process('diagram.svg', self::D2_SVG, '<p><img src="diagram.svg" alt="Un schéma"></p>');

        // Les règles sombres répondent au thème choisi sur le site…
        self::assertStringContainsString(
            \sprintf('[data-bs-theme="dark"] %s .d2-1 .fill-N7{fill:#1E1E2E;}', self::SCOPE),
            $content,
        );
        self::assertStringContainsString(
            \sprintf('[data-bs-theme="dark"] %s .shape{stroke:#000000;}', self::SCOPE),
            $content,
        );
    }

    public function testItDropsTheOperatingSystemMediaQuery(): void
    {
        $content = $this->process('diagram.svg', self::D2_SVG, '<p><img src="diagram.svg" alt="Un schéma"></p>');

        // `app.js` résout toujours le thème en `light`/`dark` explicite : conserver
        // la media query ferait diverger le diagramme de sa page avant que le JS
        // n'ait tourné, et doublerait le poids des règles sombres.
        self::assertStringNotContainsString('prefers-color-scheme', $content);
        self::assertStringNotContainsString(':root:not([data-bs-theme="light"])', $content);
    }

    public function testItHandlesEveryDarkMediaQueryNotJustTheFirst(): void
    {
        $svg = '<?xml version="1.0" encoding="utf-8"?>'
            . '<svg xmlns="http://www.w3.org/2000/svg" data-d2-version="v0.7.1" viewBox="0 0 10 10">'
            . '<style type="text/css">'
            . '@media screen and (prefers-color-scheme:dark){.d2-1 .fill-N7{fill:#111111;}}'
            . '@media screen and (prefers-color-scheme:dark){.d2-1 .fill-N1{fill:#222222;}}'
            . '</style><rect class="fill-N7"/></svg>';

        $content = $this->process('diagram.svg', $svg, '<p><img src="diagram.svg" alt="Un schéma"></p>');

        self::assertStringContainsString(
            \sprintf('[data-bs-theme="dark"] %s .d2-1 .fill-N7{fill:#111111;}', self::SCOPE),
            $content,
        );
        self::assertStringContainsString(
            \sprintf('[data-bs-theme="dark"] %s .d2-1 .fill-N1{fill:#222222;}', self::SCOPE),
            $content,
        );
        self::assertStringNotContainsString('prefers-color-scheme', $content);
    }

    public function testItSplitsSelectorListsOnTopLevelCommasOnly(): void
    {
        $svg = '<?xml version="1.0" encoding="utf-8"?>'
            . '<svg xmlns="http://www.w3.org/2000/svg" data-d2-version="v0.7.1" viewBox="0 0 10 10">'
            . '<style type="text/css">.shape,.connection:is(.a,.b){fill:red;}</style>'
            . '<rect class="shape"/></svg>';

        $content = $this->process('diagram.svg', $svg, '<p><img src="diagram.svg" alt="Un schéma"></p>');

        // La virgule de `:is(.a,.b)` ne doit pas découper le sélecteur.
        self::assertStringContainsString(
            \sprintf('%s .shape,%s .connection:is(.a,.b){fill:red;}', self::SCOPE, self::SCOPE),
            $content,
        );
    }

    /**
     * Garde-fou contre la vraie sortie de `d2`, que le SVG de test ne reproduit
     * qu'en miniature : deux blocs `<style>`, du CDATA, des polices en base64 et
     * ~190 règles, dont une vingtaine que D2 laisse nues de chaque côté du thème.
     *
     * @param string $selector sélecteur nu réellement émis par D2 0.7.1
     */
    #[DataProvider('provideSelectorsLeftUnqualifiedByD2')]
    public function testItScopesEveryRuleOfARealDiagram(string $selector): void
    {
        $svg = file_get_contents(self::realDiagramPath());

        if (false === $svg) {
            self::fail('Le diagramme de référence doit être lisible.');
        }

        $content = $this->process('flux-adr.svg', $svg, '<p><img src="flux-adr.svg" alt="Un schéma"></p>');

        self::assertGreaterThan(
            0,
            substr_count($content, \sprintf('%s{', $selector)),
            \sprintf('Le diagramme de référence doit contenir des règles `%s`.', $selector),
        );
        self::assertSame(
            substr_count($content, \sprintf('%s{', $selector)),
            substr_count($content, \sprintf('%s %s{', self::SCOPE, $selector)),
            \sprintf('Toute règle `%s` doit être scopée sur la racine du diagramme.', $selector),
        );
    }

    /**
     * @return iterable<string, array{string}>
     */
    public static function provideSelectorsLeftUnqualifiedByD2(): iterable
    {
        yield '.shape' => ['.shape'];
        yield '.connection' => ['.connection'];
        yield '.blend' => ['.blend'];
        yield '.md' => ['.md'];
        yield '.light-code' => ['.light-code'];
        yield '.dark-code' => ['.dark-code'];
        yield '.sketch-overlay-B1' => ['.sketch-overlay-B1'];
    }

    public function testItPreservesTheEmbeddedFontsOfARealDiagram(): void
    {
        $svg = file_get_contents(self::realDiagramPath());

        if (false === $svg) {
            self::fail('Le diagramme de référence doit être lisible.');
        }

        $content = $this->process('flux-adr.svg', $svg, '<p><img src="flux-adr.svg" alt="Un schéma"></p>');

        // D2 embarque ses polices en base64 : les préfixer les ferait disparaître.
        self::assertSame(substr_count($svg, '@font-face'), substr_count($content, '@font-face'));
        self::assertStringNotContainsString(self::SCOPE . ' @font-face', $content);

        self::assertSame(
            substr_count($content, '{'),
            substr_count($content, '}'),
            'Le CSS réécrit doit rester équilibré en accolades.',
        );
    }

    private static function realDiagramPath(): string
    {
        return \dirname(__DIR__, 4) . '/assets/images/articles/flux-adr.svg';
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

    public function testItInlinesEveryOccurrenceOfTheSameDiagram(): void
    {
        $content = $this->process(
            'diagram.svg',
            self::D2_SVG,
            '<p><img src="diagram.svg" alt="Un"></p><p><img src="diagram.svg" alt="Deux"></p>',
        );

        // Le cache ne doit pas transformer la deuxième occurrence en no-op.
        self::assertStringNotContainsString('<img', $content);
        self::assertSame(2, substr_count($content, 'data-d2-version="v0.7.1"'));
        self::assertStringContainsString('aria-label="Un"', $content);
        self::assertStringContainsString('aria-label="Deux"', $content);
    }

    public function testItReReadsADiagramWhoseFileChanged(): void
    {
        $sourcePath = $this->directory . '/diagram.svg';
        $this->filesystem->dumpFile($sourcePath, self::D2_SVG);

        $assetMapper = self::createStub(AssetMapperInterface::class);
        $assetMapper->method('getAsset')->willReturnCallback(
            static fn (string $requested): ?MappedAsset => 'diagram.svg' === $requested
                ? new MappedAsset('diagram.svg', $sourcePath)
                : null,
        );

        // Une seule instance : c'est elle qui porte le cache.
        $processor = new D2DiagramProcessor($assetMapper, new NaiveHtmlCrawlerManager());
        $html = '<p><img src="diagram.svg" alt="Un schéma"></p>';

        $first = ['content' => $html];
        $processor->__invoke($first, $this->content());

        $this->filesystem->dumpFile($sourcePath, str_replace('#FFFFFF', '#ABCDEF', self::D2_SVG));
        // Horodatage explicite : deux écritures dans la même seconde partageraient
        // sinon la même date de modification, et donc la même clé de cache.
        touch($sourcePath, time() + 10);
        clearstatcache(true, $sourcePath);

        $second = ['content' => $html];
        $processor->__invoke($second, $this->content());

        self::assertIsString($second['content']);
        self::assertStringContainsString('#ABCDEF', $second['content']);
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

<?php

declare(strict_types=1);

namespace App\Tests\Domain\Planka\Model;

use App\Domain\Planka\Model\BranchName;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;

#[CoversClass(BranchName::class)]
class BranchNameTest extends TestCase
{
    public function testFromTitleSlugifiesAccentsAndPunctuation(): void
    {
        $branch = BranchName::fromTitle('fix', 42, 'Réparer l\'API /producer/stats — Erreur 500 !');

        self::assertSame('fix/42-reparer-l-api-producer-stats-erreur-500', (string) $branch);
    }

    public function testFromTitleTruncatesLongTitlesOnAWordBoundary(): void
    {
        $branch = BranchName::fromTitle('feat', 1, 'Une très longue description de carte qui dépasse largement la limite fixée');

        self::assertLessThanOrEqual(BranchName::SLUG_MAX_LENGTH, \strlen($branch->slug));
        self::assertSame('une-tres-longue-description-de-carte-qui-depasse', $branch->slug);
    }

    public function testFromTitleWithoutSluggableCharacters(): void
    {
        self::assertSame('feat/5', (string) BranchName::fromTitle('feat', 5, '???'));
    }

    public function testParseRoundTrip(): void
    {
        $branch = BranchName::parse('feat/42-corriger-le-flux-rss');

        self::assertNotNull($branch);
        self::assertSame('feat', $branch->prefix);
        self::assertSame(42, $branch->number);
        self::assertSame('corriger-le-flux-rss', $branch->slug);
        self::assertSame('fix/42-corriger-le-flux-rss', (string) $branch->withPrefix('fix'));
    }

    public function testParseRejectsHandWrittenValues(): void
    {
        self::assertNull(BranchName::parse(''));
        self::assertNull(BranchName::parse('ma-branche-perso'));
        self::assertNull(BranchName::parse('feat/sans-numero'));
    }
}

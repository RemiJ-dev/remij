<?php

declare(strict_types=1);

namespace App\Tests\Domain\Planka\Service;

use App\Domain\Planka\DTO\Board;
use App\Domain\Planka\DTO\BranchField;
use App\Domain\Planka\DTO\Card;
use App\Domain\Planka\DTO\NumberingResult;
use App\Domain\Planka\Repository\CardCounterRepository;
use App\Domain\Planka\Service\CardNumberer;
use App\Infrastructure\Planka\PlankaClient;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Filesystem\Filesystem;

#[CoversClass(CardNumberer::class)]
class CardNumbererTest extends TestCase
{
    private const string BUG = 'label-bug';
    private const string EVOLUTION = 'label-evolution';
    private const string OTHER = 'label-other';

    private string $counterPath;

    protected function setUp(): void
    {
        $this->counterPath = sys_get_temp_dir() . '/planka-numberer-' . bin2hex(random_bytes(4)) . '/counters.json';
    }

    protected function tearDown(): void
    {
        new Filesystem()->remove(\dirname($this->counterPath));
    }

    public function testNewCardIsNumberedAfterTheHighestNumberOfTheBoard(): void
    {
        $card = new Card('100', 'Corriger le flux RSS', 'board', '2026-09-30T10:00:00Z', [self::BUG]);
        $board = $this->board([new Card('1', '#7 · Ancienne carte', 'board', '2026-01-01T00:00:00Z'), $card]);

        $client = $this->client($board, [$card]);
        $client->expects(self::once())->method('renameCard')->with('100', '#8 · Corriger le flux RSS');
        $client->expects(self::once())->method('setCustomFieldValue')->with('100', $board->branchField, 'fix/8-corriger-le-flux-rss');

        $result = $this->numberer($client)->numberNewCard('100');

        self::assertSame(NumberingResult::NUMBERED, $result->status);
        self::assertSame('#8 · Corriger le flux RSS', $result->title);
        self::assertSame('fix/8-corriger-le-flux-rss', $result->branch);
    }

    public function testDuplicatedCardGetsANewNumber(): void
    {
        $original = new Card('1', '#3 · Titre', 'board', '2026-01-01T00:00:00Z');
        $copy = new Card('2', '#3 · Titre (copie)', 'board', '2026-01-02T00:00:00Z');
        $board = $this->board([$original, $copy]);

        $client = $this->client($board, [$copy]);
        $client->expects(self::once())->method('renameCard')->with('2', '#4 · Titre (copie)');

        self::assertSame('feat/4-titre-copie', $this->numberer($client)->numberNewCard('2')->branch);
    }

    public function testFirstMatchingLabelOfTheConfigurationWins(): void
    {
        $card = new Card('100', 'Titre', 'board', '2026-09-30T10:00:00Z', [self::EVOLUTION, self::BUG]);

        $result = $this->numberer($this->stubClient($this->board([$card]), [$card]))->numberNewCard('100');

        self::assertSame('fix/1-titre', $result->branch);
    }

    public function testCardWithoutMappedLabelUsesTheDefaultPrefix(): void
    {
        $card = new Card('100', 'Titre', 'board', '2026-09-30T10:00:00Z', [self::OTHER]);

        $result = $this->numberer($this->stubClient($this->board([$card]), [$card]))->numberNewCard('100');

        self::assertSame('feat/1-titre', $result->branch);
    }

    public function testInaccessibleCardIsIgnoredWithoutWriting(): void
    {
        $client = self::createMock(PlankaClient::class);
        $client->method('findCard')->willReturn(null);
        $client->expects(self::never())->method('renameCard');
        $client->expects(self::never())->method('setCustomFieldValue');

        $result = $this->numberer($client)->numberNewCard('100');

        self::assertSame(NumberingResult::IGNORED, $result->status);
        self::assertSame(0, new CardCounterRepository($this->counterPath)->current('project'), 'No number must be reserved.');
    }

    public function testBoardWithoutBranchFieldOnlyRenamesTheCard(): void
    {
        $card = new Card('100', 'Titre', 'board', '2026-09-30T10:00:00Z');
        $board = new Board('board', 'project', [], null, [$card]);

        $client = $this->client($board, [$card]);
        $client->expects(self::once())->method('renameCard')->with('100', '#1 · Titre');
        $client->expects(self::never())->method('setCustomFieldValue');

        $result = $this->numberer($client)->numberNewCard('100');

        self::assertSame(NumberingResult::NUMBERED, $result->status);
        self::assertNull($result->branch);
        self::assertSame('no branch field on this board', $result->reason);
    }

    public function testRefreshBranchPrefixKeepsNumberAndSlug(): void
    {
        $field = new BranchField('group', 'field');
        $card = new Card('100', '#42 · Titre renommé depuis', 'board', '2026-09-30T10:00:00Z', [self::BUG], [$field->key() => 'feat/42-titre-d-origine']);

        $client = $this->client($this->board([$card]), [$card]);
        $client->expects(self::once())->method('setCustomFieldValue')->with('100', $field, 'fix/42-titre-d-origine');
        $client->expects(self::never())->method('renameCard');

        self::assertSame(NumberingResult::UPDATED, $this->numberer($client)->refreshBranchPrefix('100')->status);
    }

    public function testRefreshBranchPrefixWithoutChange(): void
    {
        $field = new BranchField('group', 'field');
        $card = new Card('100', '#42 · Titre', 'board', '2026-09-30T10:00:00Z', [], [$field->key() => 'feat/42-titre']);

        $client = $this->client($this->board([$card]), [$card]);
        $client->expects(self::never())->method('setCustomFieldValue');

        self::assertSame(NumberingResult::UNCHANGED, $this->numberer($client)->refreshBranchPrefix('100')->status);
    }

    public function testRefreshBranchPrefixFillsAnEmptyFieldOfANumberedCard(): void
    {
        $card = new Card('100', '#42 · Titre', 'board', '2026-09-30T10:00:00Z', [self::BUG]);

        $client = $this->client($this->board([$card]), [$card]);
        $client->expects(self::once())->method('setCustomFieldValue')->with('100', self::anything(), 'fix/42-titre');

        self::assertSame(NumberingResult::UPDATED, $this->numberer($client)->refreshBranchPrefix('100')->status);
    }

    public function testRefreshBranchPrefixIgnoresUnnumberedCards(): void
    {
        $card = new Card('100', 'Titre', 'board', '2026-09-30T10:00:00Z', [self::BUG]);

        $client = $this->client($this->board([$card]), [$card]);
        $client->expects(self::never())->method('setCustomFieldValue');

        self::assertSame(NumberingResult::IGNORED, $this->numberer($client)->refreshBranchPrefix('100')->status);
    }

    public function testNumberExistingCardsFollowsCreationOrderAndKeepsExistingNumbers(): void
    {
        $newest = new Card('3', 'Récente', 'board', '2026-03-01T00:00:00Z');
        $oldest = new Card('1', 'Ancienne', 'board', '2020-01-01T00:00:00Z', [self::BUG]);
        $numbered = new Card('2', '#9 · Déjà numérotée', 'board', '2022-01-01T00:00:00Z');
        $closed = new Card('4', 'Fermée', 'board', '2021-01-01T00:00:00Z');
        $board = $this->board([$newest, $oldest, $numbered, $closed]);

        $client = $this->client($board, [$newest, $oldest, $numbered, $closed]);

        $renamed = [];
        $client->expects(self::exactly(3))->method('renameCard')
            ->willReturnCallback(static function (string $cardId, string $name) use (&$renamed): void {
                $renamed[] = $name;
            });
        $client->expects(self::exactly(4))->method('setCustomFieldValue');

        $results = iterator_to_array($this->numberer($client)->numberExistingCards('board'), false);

        self::assertSame(['#10 · Ancienne', '#11 · Fermée', '#12 · Récente'], $renamed);
        self::assertSame(
            [NumberingResult::NUMBERED, NumberingResult::NUMBERED, NumberingResult::UPDATED, NumberingResult::NUMBERED],
            array_map(static fn (NumberingResult $result): string => $result->status, $results),
        );
        self::assertSame('feat/9-deja-numerotee', $results[2]->branch);
        self::assertSame('fix/10-ancienne', $results[0]->branch);
    }

    public function testNumberExistingCardsDryRunWritesNothing(): void
    {
        $card = new Card('1', 'Ancienne', 'board', '2020-01-01T00:00:00Z');

        $client = $this->client($this->board([$card]), [$card]);
        $client->expects(self::never())->method('renameCard');
        $client->expects(self::never())->method('setCustomFieldValue');

        $results = iterator_to_array($this->numberer($client)->numberExistingCards('board', true), false);

        self::assertSame('#1 · Ancienne', $results[0]->title);
        self::assertSame(0, new CardCounterRepository($this->counterPath)->current('project'), 'A dry run must not reserve numbers.');
    }

    /**
     * @param list<Card> $cards
     */
    private function board(array $cards): Board
    {
        return new Board(
            'board',
            'project',
            [self::BUG => 'Bug', self::EVOLUTION => 'Evolution', self::OTHER => 'API'],
            new BranchField('group', 'field'),
            $cards,
        );
    }

    /**
     * @param list<Card> $cards cartes renvoyées par findCard(), par id
     */
    private function client(Board $board, array $cards): PlankaClient&MockObject
    {
        $client = self::createMock(PlankaClient::class);
        $client->method('findBoard')->willReturn($board);
        $client->method('findCard')->willReturnCallback(self::cardFinder($cards));

        return $client;
    }

    /**
     * @param list<Card> $cards
     */
    private function stubClient(Board $board, array $cards): PlankaClient
    {
        $client = self::createStub(PlankaClient::class);
        $client->method('findBoard')->willReturn($board);
        $client->method('findCard')->willReturnCallback(self::cardFinder($cards));

        return $client;
    }

    /**
     * @param list<Card> $cards
     *
     * @return \Closure(string): ?Card
     */
    private static function cardFinder(array $cards): \Closure
    {
        $byId = [];
        foreach ($cards as $card) {
            $byId[$card->id] = $card;
        }

        return static fn (string $cardId): ?Card => $byId[$cardId] ?? null;
    }

    private function numberer(PlankaClient $client): CardNumberer
    {
        return new CardNumberer(
            $client,
            new CardCounterRepository($this->counterPath),
            ['Bug' => 'fix', 'Evolution' => 'feat'],
            'feat',
        );
    }
}

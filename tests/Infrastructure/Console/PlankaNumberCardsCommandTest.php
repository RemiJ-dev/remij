<?php

declare(strict_types=1);

namespace App\Tests\Infrastructure\Console;

use App\Domain\Planka\DTO\NumberingResult;
use App\Domain\Planka\Service\CardNumberer;
use App\Infrastructure\Console\PlankaNumberCardsCommand;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Console\Application;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Tester\CommandTester;

#[CoversClass(PlankaNumberCardsCommand::class)]
class PlankaNumberCardsCommandTest extends TestCase
{
    public function testDryRunIsForwardedAndResultsAreListed(): void
    {
        $numberer = self::createMock(CardNumberer::class);
        $numberer->expects(self::once())
            ->method('numberExistingCards')
            ->with('board-1', true)
            ->willReturn([
                NumberingResult::numbered('1', '#1 · Ancienne', 'fix/1-ancienne'),
                NumberingResult::unchanged('2', 'feat/2-deja-faite'),
            ]);

        $tester = self::tester($numberer);
        $tester->execute(['board-id' => 'board-1', '--dry-run' => true]);

        $tester->assertCommandIsSuccessful();
        $display = $tester->getDisplay();
        self::assertStringContainsString('Dry run', $display);
        self::assertStringContainsString('fix/1-ancienne', $display);
        self::assertStringNotContainsString('feat/2-deja-faite', $display, 'Unchanged cards are only counted.');
    }

    public function testIgnoredResultsMakeTheCommandFail(): void
    {
        $numberer = self::createStub(CardNumberer::class);
        $numberer->method('numberExistingCards')->willReturn([NumberingResult::ignored(null, 'board board-1 not accessible to the hooks account')]);

        $tester = self::tester($numberer);

        self::assertSame(Command::FAILURE, $tester->execute(['board-id' => 'board-1']));
    }

    private static function tester(CardNumberer $numberer): CommandTester
    {
        $application = new Application();
        $application->addCommand(new PlankaNumberCardsCommand($numberer));

        return new CommandTester($application->find('app:planka:number-cards'));
    }
}

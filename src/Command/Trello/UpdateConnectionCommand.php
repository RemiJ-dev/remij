<?php

declare(strict_types=1);

namespace App\Command\Trello;

use App\Trello\ConnectionRepository;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(name: 'trello:update', description: 'Update an existing Trello→Mattermost connection')]
final class UpdateConnectionCommand extends Command
{
    public function __construct(
        private readonly ConnectionRepository $repository,
    ) {
        parent::__construct();
    }

    protected function configure(): void
    {
        $this
            ->addArgument('board-id', InputArgument::REQUIRED, 'Trello board ID')
            ->addOption('mattermost-channel', null, InputOption::VALUE_REQUIRED, 'New Mattermost channel name or ID');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        /** @var string $boardId */
        $boardId = $input->getArgument('board-id');

        $connection = $this->repository->find($boardId);
        if (null === $connection) {
            $io->error(\sprintf('No connection found for board "%s".', $boardId));

            return Command::FAILURE;
        }

        /** @var string|null $mattermostChannel */
        $mattermostChannel = $input->getOption('mattermost-channel');

        if (null === $mattermostChannel) {
            $io->error('Nothing to update. Use --mattermost-channel to specify a new channel.');

            return Command::FAILURE;
        }

        $updated = $connection->withMattermostChannel($mattermostChannel);
        $this->repository->save($updated);

        $io->success(\sprintf(
            'Connection "%s" updated: Mattermost channel → #%s',
            $connection->boardName,
            $mattermostChannel,
        ));

        return Command::SUCCESS;
    }
}

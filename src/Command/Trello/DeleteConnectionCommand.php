<?php

declare(strict_types=1);

namespace App\Command\Trello;

use App\Trello\ConnectionRepository;
use App\Trello\TrelloApiClient;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(name: 'trello:delete', description: 'Delete a Trello→Mattermost connection')]
final class DeleteConnectionCommand extends Command
{
    public function __construct(
        private readonly ConnectionRepository $repository,
        private readonly TrelloApiClient $trelloApiClient,
    ) {
        parent::__construct();
    }

    protected function configure(): void
    {
        $this->addArgument('board-id', InputArgument::REQUIRED, 'Trello board ID');
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

        $io->text(\sprintf('Removing Trello webhook <info>%s</info>…', $connection->trelloWebhookId));
        $this->trelloApiClient->deleteWebhook($connection->trelloWebhookId);

        $this->repository->delete($boardId);

        $io->success(\sprintf('Connection for board "%s" deleted.', $connection->boardName));

        return Command::SUCCESS;
    }
}

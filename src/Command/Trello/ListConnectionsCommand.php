<?php

declare(strict_types=1);

namespace App\Command\Trello;

use App\Trello\ConnectionRepository;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(name: 'trello:list', description: 'List all Trello→Mattermost connections')]
final class ListConnectionsCommand extends Command
{
    public function __construct(
        private readonly ConnectionRepository $repository,
    ) {
        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $connections = $this->repository->findAll();

        if ([] === $connections) {
            $output->writeln('<comment>No connections found.</comment>');

            return Command::SUCCESS;
        }

        $table = new Table($output);
        $table->setHeaders(['Board ID', 'Board Name', 'Mattermost Channel', 'Trello Webhook ID', 'Created At']);

        foreach ($connections as $connection) {
            $table->addRow([
                $connection->boardId,
                $connection->boardName,
                $connection->mattermostChannel,
                $connection->trelloWebhookId,
                $connection->createdAt->format('Y-m-d H:i:s'),
            ]);
        }

        $table->render();

        return Command::SUCCESS;
    }
}

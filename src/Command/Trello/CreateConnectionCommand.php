<?php

declare(strict_types=1);

namespace App\Command\Trello;

use App\Trello\Connection;
use App\Trello\ConnectionRepository;
use App\Trello\TrelloApiClient;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(name: 'trello:create', description: 'Create a new Trello→Mattermost connection')]
final class CreateConnectionCommand extends Command
{
    public function __construct(
        private readonly ConnectionRepository $repository,
        private readonly TrelloApiClient $trelloApiClient,
        private readonly string $webhookCallbackUrl,
    ) {
        parent::__construct();
    }

    protected function configure(): void
    {
        $this
            ->addArgument('board-id', InputArgument::REQUIRED, 'Trello board ID')
            ->addArgument('mattermost-channel', InputArgument::REQUIRED, 'Mattermost channel name or ID');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        /** @var string $boardId */
        $boardId = $input->getArgument('board-id');
        /** @var string $mattermostChannel */
        $mattermostChannel = $input->getArgument('mattermost-channel');

        if (null !== $this->repository->find($boardId)) {
            $io->error(\sprintf('A connection for board "%s" already exists. Use trello:update to modify it.', $boardId));

            return Command::FAILURE;
        }

        $io->text(\sprintf('Fetching board name for <info>%s</info>…', $boardId));
        $boardName = $this->trelloApiClient->getBoardName($boardId);

        $io->text(\sprintf('Registering Trello webhook for board <info>%s</info>…', $boardName));
        $webhookId = $this->trelloApiClient->createWebhook($boardId, $this->webhookCallbackUrl);

        $now = new \DateTimeImmutable();
        $connection = new Connection(
            boardId: $boardId,
            boardName: $boardName,
            trelloWebhookId: $webhookId,
            mattermostChannel: $mattermostChannel,
            createdAt: $now,
            updatedAt: $now,
        );

        $this->repository->save($connection);

        $io->success(\sprintf(
            'Connection created: board "%s" → Mattermost channel #%s',
            $boardName,
            $mattermostChannel,
        ));

        return Command::SUCCESS;
    }
}

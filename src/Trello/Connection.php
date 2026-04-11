<?php

declare(strict_types=1);

namespace App\Trello;

final readonly class Connection
{
    public function __construct(
        public string $boardId,
        public string $boardName,
        public string $trelloWebhookId,
        public string $mattermostChannel,
        public \DateTimeImmutable $createdAt,
        public \DateTimeImmutable $updatedAt,
    ) {
    }

    public function withMattermostChannel(string $mattermostChannel): self
    {
        return new self(
            $this->boardId,
            $this->boardName,
            $this->trelloWebhookId,
            $mattermostChannel,
            $this->createdAt,
            new \DateTimeImmutable(),
        );
    }

    /**
     * @param array<string, mixed> $data
     *
     * @throws \InvalidArgumentException
     * @throws \DateMalformedStringException
     */
    public static function fromArray(array $data): self
    {
        return new self(
            boardId: \is_string($data['boardId']) ? $data['boardId'] : throw new \InvalidArgumentException('boardId must be a string'),
            boardName: \is_string($data['boardName']) ? $data['boardName'] : throw new \InvalidArgumentException('boardName must be a string'),
            trelloWebhookId: \is_string($data['trelloWebhookId']) ? $data['trelloWebhookId'] : throw new \InvalidArgumentException('trelloWebhookId must be a string'),
            mattermostChannel: \is_string($data['mattermostChannel']) ? $data['mattermostChannel'] : throw new \InvalidArgumentException('mattermostChannel must be a string'),
            createdAt: new \DateTimeImmutable(\is_string($data['createdAt']) ? $data['createdAt'] : throw new \InvalidArgumentException('createdAt must be a string')),
            updatedAt: new \DateTimeImmutable(\is_string($data['updatedAt']) ? $data['updatedAt'] : throw new \InvalidArgumentException('updatedAt must be a string')),
        );
    }

    /** @return array<string, string> */
    public function toArray(): array
    {
        return [
            'boardId' => $this->boardId,
            'boardName' => $this->boardName,
            'trelloWebhookId' => $this->trelloWebhookId,
            'mattermostChannel' => $this->mattermostChannel,
            'createdAt' => $this->createdAt->format(\DateTimeInterface::ATOM),
            'updatedAt' => $this->updatedAt->format(\DateTimeInterface::ATOM),
        ];
    }
}

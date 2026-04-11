<?php

declare(strict_types=1);

namespace App\MessageHandler;

use App\Message\TrelloEvent;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;
use Symfony\Component\Notifier\Bridge\Mattermost\MattermostOptions;
use Symfony\Component\Notifier\ChatterInterface;
use Symfony\Component\Notifier\Message\ChatMessage;

#[AsMessageHandler]
final readonly class TrelloEventHandler
{
    public function __construct(
        private ChatterInterface $chatter,
    ) {
    }

    public function __invoke(TrelloEvent $event): void
    {
        $text = $this->formatMessage($event->payload);
        if (null === $text) {
            return;
        }

        $message = new ChatMessage($text);
        $message->options(
            (new MattermostOptions())->recipient($event->connection->mattermostChannel),
        );

        $this->chatter->send($message);
    }

    /** @param array<string, mixed> $payload */
    private function formatMessage(array $payload): ?string
    {
        /** @var array<string, mixed> $action */
        $action = \is_array($payload['action'] ?? null) ? $payload['action'] : [];
        $type = \is_string($action['type'] ?? null) ? $action['type'] : '';
        /** @var array<string, mixed> $data */
        $data = \is_array($action['data'] ?? null) ? $action['data'] : [];
        /** @var array<string, mixed> $memberCreator */
        $memberCreator = \is_array($action['memberCreator'] ?? null) ? $action['memberCreator'] : [];
        $author = \is_string($memberCreator['fullName'] ?? null) ? $memberCreator['fullName'] : 'Someone';

        /** @var array<string, mixed> $card */
        $card = \is_array($data['card'] ?? null) ? $data['card'] : [];
        /** @var array<string, mixed> $list */
        $list = \is_array($data['list'] ?? null) ? $data['list'] : [];
        /** @var array<string, mixed> $listAfter */
        $listAfter = \is_array($data['listAfter'] ?? null) ? $data['listAfter'] : [];
        /** @var array<string, mixed> $board */
        $board = \is_array($data['board'] ?? null) ? $data['board'] : [];

        $cardName = \is_string($card['name'] ?? null) ? $card['name'] : '';
        $listName = \is_string($list['name'] ?? null) ? $list['name'] : (\is_string($listAfter['name'] ?? null) ? $listAfter['name'] : '');
        $boardName = \is_string($board['name'] ?? null) ? $board['name'] : '';

        return match ($type) {
            'createCard' => \sprintf(':sparkles: **%s** a créé la carte **%s** dans *%s*', $author, $cardName, $listName),
            'updateCard' => $this->formatUpdateCard($data, $author, $cardName),
            'commentCard' => $this->formatCommentCard($data, $author, $cardName),
            'deleteCard' => \sprintf(':wastebasket: **%s** a supprimé la carte **%s** de *%s*', $author, $cardName, $boardName),
            'archiveCard', 'closeCard' => \sprintf(':wastebasket: **%s** a archivé la carte **%s**', $author, $cardName),
            'addMemberToCard' => $this->formatAddMember($data, $author, $cardName),
            'removeMemberFromCard' => $this->formatRemoveMember($data, $author, $cardName),
            'addAttachmentToCard' => \sprintf(':paperclip: **%s** a ajouté une pièce jointe à **%s**', $author, $cardName),
            'createList' => \sprintf(':memo: **%s** a créé la liste *%s*', $author, $listName),
            'updateList' => \sprintf(':pencil: **%s** a modifié la liste *%s*', $author, $listName),
            default => null,
        };
    }

    /** @param array<string, mixed> $data */
    private function formatUpdateCard(array $data, string $author, string $cardName): ?string
    {
        /** @var array<string, mixed> $old */
        $old = \is_array($data['old'] ?? null) ? $data['old'] : [];
        /** @var array<string, mixed> $card */
        $card = \is_array($data['card'] ?? null) ? $data['card'] : [];
        /** @var array<string, mixed> $listBefore */
        $listBefore = \is_array($data['listBefore'] ?? null) ? $data['listBefore'] : [];
        /** @var array<string, mixed> $listAfter */
        $listAfter = \is_array($data['listAfter'] ?? null) ? $data['listAfter'] : [];

        if (isset($old['idList'])) {
            $fromList = \is_string($listBefore['name'] ?? null) ? $listBefore['name'] : '?';
            $toList = \is_string($listAfter['name'] ?? null) ? $listAfter['name'] : '?';

            return \sprintf(':arrow_right: **%s** a déplacé **%s** de *%s* vers *%s*', $author, $cardName, $fromList, $toList);
        }

        if (isset($old['name'])) {
            $oldName = \is_string($old['name']) ? $old['name'] : '';

            return \sprintf(':pencil: **%s** a renommé **%s** en **%s**', $author, $oldName, $cardName);
        }

        if (isset($old['closed'])) {
            $closed = $card['closed'] ?? null;
            if (true === $closed) {
                return \sprintf(':wastebasket: **%s** a archivé la carte **%s**', $author, $cardName);
            }
            if (false === $closed) {
                return \sprintf(':inbox_tray: **%s** a désarchivé la carte **%s**', $author, $cardName);
            }
        }

        if (isset($old['desc'])) {
            return \sprintf(':pencil: **%s** a modifié la description de **%s**', $author, $cardName);
        }

        if (isset($old['due'])) {
            $due = $card['due'] ?? null;
            if (null === $due) {
                return \sprintf(':calendar: **%s** a supprimé l\'échéance de **%s**', $author, $cardName);
            }
            if (\is_string($due)) {
                try {
                    $date = new \DateTimeImmutable($due);

                    return \sprintf(':calendar: **%s** a défini l\'échéance de **%s** au %s', $author, $cardName, $date->format('d/m/Y'));
                } catch (\DateMalformedStringException) {
                    // ignore malformed date
                }
            }
        }

        return null;
    }

    /** @param array<string, mixed> $data */
    private function formatCommentCard(array $data, string $author, string $cardName): string
    {
        $text = \is_string($data['text'] ?? null) ? $data['text'] : '';

        return \sprintf(':speech_balloon: **%s** a commenté **%s** : _%s_', $author, $cardName, $text);
    }

    /** @param array<string, mixed> $data */
    private function formatAddMember(array $data, string $author, string $cardName): string
    {
        /** @var array<string, mixed> $member */
        $member = \is_array($data['member'] ?? null) ? $data['member'] : [];
        $name = \is_string($member['name'] ?? null) ? $member['name'] : $author;

        return \sprintf(':bust_in_silhouette: **%s** a été ajouté(e) à la carte **%s**', $name, $cardName);
    }

    /** @param array<string, mixed> $data */
    private function formatRemoveMember(array $data, string $author, string $cardName): string
    {
        /** @var array<string, mixed> $member */
        $member = \is_array($data['member'] ?? null) ? $data['member'] : [];
        $name = \is_string($member['name'] ?? null) ? $member['name'] : $author;

        return \sprintf(':bust_in_silhouette: **%s** a été retiré(e) de la carte **%s**', $name, $cardName);
    }
}

<?php

declare(strict_types=1);

namespace App\Responder\Publication;

use App\Domain\Publication\DTO\FeedEntry;
use App\Responder\AbstractTwigResponder;
use Symfony\Component\HttpFoundation\Response;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

class RssResponder extends AbstractTwigResponder
{
    /**
     * @param list<FeedEntry> $entries
     *
     * @throws RuntimeError
     * @throws SyntaxError
     * @throws LoaderError
     */
    public function __invoke(array $entries): Response
    {
        $lastModified = [] === $entries
            ? null
            : max(array_map(static fn (FeedEntry $entry): \DateTimeInterface => $entry->updated, $entries));

        $response = $this->render('rss/rss.xml.twig', [
            'entries' => $entries,
            'lastModified' => $lastModified,
        ])->setLastModified($lastModified);
        $response->headers->set('Content-Type', 'application/atom+xml; charset=utf-8');

        return $response;
    }
}

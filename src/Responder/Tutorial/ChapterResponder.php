<?php

declare(strict_types=1);

namespace App\Responder\Tutorial;

use App\Domain\Tutorial\Model\Chapter;
use App\Domain\Tutorial\Model\Tutorial;
use App\Responder\AbstractTwigResponder;
use Symfony\Component\HttpFoundation\Response;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

class ChapterResponder extends AbstractTwigResponder
{
    /**
     * Previous/next navigation only links published chapters.
     *
     * @param array<string, Chapter> $chapters All chapters of the tutorial, ordered by position
     *
     * @throws RuntimeError
     * @throws SyntaxError
     * @throws LoaderError
     */
    public function respond(Tutorial $tutorial, Chapter $chapter, array $chapters): Response
    {
        $published = array_values(array_filter(
            $chapters,
            static fn (Chapter $candidate): bool => $candidate->isPublished(),
        ));
        $index = array_search(
            $chapter->slug,
            array_map(static fn (Chapter $candidate): string => $candidate->slug, $published),
            true,
        );

        return $this->render('tutorials/chapter.html.twig', [
            'tutorial' => $tutorial,
            'chapter' => $chapter,
            'previousChapter' => false === $index ? null : ($published[$index - 1] ?? null),
            'nextChapter' => false === $index ? null : ($published[$index + 1] ?? null),
        ])->setLastModified($chapter->getLastModifiedOrCreated());
    }
}

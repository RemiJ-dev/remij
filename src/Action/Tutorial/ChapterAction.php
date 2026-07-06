<?php

declare(strict_types=1);

namespace App\Action\Tutorial;

use App\Domain\Tutorial\Model\Chapter;
use App\Domain\Tutorial\Repository\TutorialRepository;
use App\Responder\Tutorial\ChapterResponder;
use Stenope\Bundle\Exception\ContentNotFoundException;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Attribute\Route;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

readonly class ChapterAction
{
    /**
     * @throws RuntimeError
     * @throws SyntaxError
     * @throws LoaderError
     *
     * A chapter slug always contains a slash (`<tutorial>/<chapter>`), which
     * distinguishes this route from `tutorial_show`.
     */
    #[Route('/tutoriels/{slug:chapter<.+/.+>}', name: 'tutorial_chapter')]
    public function __invoke(
        Chapter $chapter,
        TutorialRepository $repository,
        ChapterResponder $responder,
    ): Response {
        try {
            $tutorial = $repository->findBySlug($chapter->getTutorialSlug());
        } catch (ContentNotFoundException $exception) {
            throw new NotFoundHttpException(\sprintf(
                'Tutorial not found for chapter "%s". Did you forget to create the `content/tutoriels/%s.md` file?',
                $chapter->slug,
                $chapter->getTutorialSlug(),
            ), $exception);
        }

        return $responder($tutorial, $chapter, $repository->findChapters($tutorial));
    }
}

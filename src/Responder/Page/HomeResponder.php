<?php

declare(strict_types=1);

namespace App\Responder\Page;

use App\Domain\Page\Model\Section;
use App\Responder\AbstractTwigResponder;
use Symfony\Component\HttpFoundation\Response;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

class HomeResponder extends AbstractTwigResponder
{
    /**
     * @param array<string, Section> $sections
     *
     * @throws RuntimeError
     * @throws SyntaxError
     * @throws LoaderError
     */
    public function respond(array $sections): Response
    {
        return $this->render('pages/home.html.twig', [
            'sections' => $sections,
        ]);
    }
}

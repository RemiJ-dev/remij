<?php

declare(strict_types=1);

namespace App\Action\Page;

use App\Domain\Page\Repository\PageRepository;
use App\Responder\Page\ContactResponder;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
use Symfony\Component\Routing\Attribute\Route;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

readonly class ContactAction
{
    /**
     * @throws TransportExceptionInterface
     * @throws LoaderError
     * @throws RuntimeError
     * @throws SyntaxError
     */
    #[Route('/contact', name: 'page_contact', methods: ['GET', 'POST'])]
    public function __invoke(
        Request $request,
        PageRepository $pageRepository,
        ContactResponder $responder,
    ): Response {
        $page = $pageRepository->findBySlug('contact');

        return $responder->respond($page, $request);
    }
}

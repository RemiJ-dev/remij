<?php

declare(strict_types=1);

namespace App\Action\Page;

use App\Domain\Page\Repository\PageRepository;
use App\Infrastructure\Form\Handler\ContactFormHandler;
use App\Responder\Page\ContactResponder;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Contracts\Translation\TranslatorInterface;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

class ContactAction extends AbstractController
{
    public function __construct(
        private readonly PageRepository $pageRepository,
        private readonly ContactFormHandler $formHandler,
        private readonly ContactResponder $responder,
    ) {
    }

    /**
     * @throws TransportExceptionInterface
     * @throws LoaderError
     * @throws RuntimeError
     * @throws SyntaxError
     */
    #[Route('/contact', name: 'page_contact', methods: ['GET', 'POST'])]
    public function __invoke(Request $request, TranslatorInterface $translator): Response
    {
        $page = $this->pageRepository->findBySlug('contact');
        $result = $this->formHandler->handle($request);

        if ($result->sent) {
            $this->addFlash('success', $translator->trans('contact.flash.success'));

            return $this->redirectToRoute('page_contact');
        }

        return ($this->responder)($page, $result->form);
    }
}

<?php

declare(strict_types=1);

namespace App\Action\Page;

use App\Domain\Page\Repository\PageRepository;
use App\Infrastructure\Form\Handler\ContactFormHandler;
use App\Responder\Page\ContactResponder;
use Symfony\Bundle\FrameworkBundle\Controller\ControllerHelper;
use Symfony\Component\DependencyInjection\Attribute\AutowireMethodOf;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Contracts\Translation\TranslatorInterface;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

readonly class ContactAction
{
    /**
     * @param \Closure(string, array<string, mixed>=, int=): RedirectResponse $redirectToRoute
     */
    public function __construct(
        #[AutowireMethodOf(ControllerHelper::class)]
        private \Closure $addFlash,
        #[AutowireMethodOf(ControllerHelper::class)]
        private \Closure $redirectToRoute,
    ) {
    }

    /**
     * @throws TransportExceptionInterface
     * @throws LoaderError
     * @throws RuntimeError
     * @throws SyntaxError
     */
    #[Route('/contact', name: 'page_contact', methods: ['GET', 'POST'])]
    public function __invoke(
        Request $request,
        TranslatorInterface $translator,
        PageRepository $pageRepository,
        ContactFormHandler $formHandler,
        ContactResponder $responder,
    ): Response {
        $page = $pageRepository->findBySlug('contact');
        $result = $formHandler->handle($request);

        if ($result->sent) {
            if ($result->success) {
                ($this->addFlash)('success', $translator->trans('contact.flash.success'));

                return ($this->redirectToRoute)('page_contact');
            }

            return ($responder)($page, $result->form, Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        return ($responder)($page, $result->form);
    }
}

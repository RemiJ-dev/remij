<?php

declare(strict_types=1);

namespace App\Responder\Page;

use App\Domain\Page\Model\Page;
use App\Infrastructure\Form\Handler\ContactFormHandler;
use App\Responder\AbstractTwigResponder;
use Symfony\Bundle\FrameworkBundle\Controller\ControllerHelper;
use Symfony\Component\DependencyInjection\Attribute\AutowireMethodOf;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
use Symfony\Contracts\Translation\TranslatorInterface;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

class ContactResponder extends AbstractTwigResponder
{
    public function __construct(
        #[AutowireMethodOf(ControllerHelper::class)] \Closure $addFlash,
        #[AutowireMethodOf(ControllerHelper::class)] \Closure $redirectToRoute,
        #[AutowireMethodOf(ControllerHelper::class)] \Closure $render,
        private readonly TranslatorInterface $translator,
        private readonly ContactFormHandler $formHandler,
    ) {
        parent::__construct($addFlash, $redirectToRoute, $render);
    }

    /**
     * @throws RuntimeError
     * @throws SyntaxError
     * @throws LoaderError
     * @throws TransportExceptionInterface
     */
    public function respond(Page $page, Request $request): Response
    {
        $status = Response::HTTP_OK;
        $result = $this->formHandler->handle($request);

        if ($result->sent) {
            if ($result->success) {
                ($this->addFlash)('success', $this->translator->trans('contact.flash.success'));

                return ($this->redirectToRoute)('page_contact');
            }

            $status = Response::HTTP_UNPROCESSABLE_ENTITY;
        }

        return $this->render('pages/contact.html.twig', [
            'page' => $page,
            'form' => $result->form->createView(),
        ], $status);
    }
}

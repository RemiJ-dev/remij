<?php

declare(strict_types=1);

namespace App\Responder\Page;

use App\Domain\Page\DTO\ContactDTO;
use App\Domain\Page\Model\Page;
use App\Responder\AbstractTwigResponder;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Response;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

class ContactResponder extends AbstractTwigResponder
{
    /**
     * @param FormInterface<ContactDTO> $form
     *
     * @throws RuntimeError
     * @throws SyntaxError
     * @throws LoaderError
     */
    public function __invoke(Page $page, FormInterface $form, int $status = Response::HTTP_OK): Response
    {
        return $this->render('pages/contact.html.twig', [
            'page' => $page,
            'form' => $form->createView(),
        ], $status);
    }
}

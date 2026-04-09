<?php

declare(strict_types=1);

namespace App\Controller\Page;

use App\Form\ContactType;
use App\Form\DTO\ContactDTO;
use App\Model\Page;
use Stenope\Bundle\ContentManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Contracts\Translation\TranslatorInterface;

class ContactAction extends AbstractController
{
    public function __construct(private readonly ContentManagerInterface $manager)
    {
    }

    /**
     * @throws TransportExceptionInterface
     */
    #[Route('/contact', name: 'page_contact', methods: ['GET', 'POST'])]
    public function __invoke(Request $request, MailerInterface $mailer, TranslatorInterface $translator): Response
    {
        $page = $this->manager->getContent(Page::class, 'contact');

        $data = new ContactDTO();
        $form = $this->createForm(ContactType::class, $data);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $email = new Email()
                ->from('contact@remij.dev')
                ->to('bonjour@remij.dev')
                ->replyTo($data->email)
                ->subject($translator->trans('contact.email.subject', ['subject' => $data->subject]))
                ->text($translator->trans('contact.email.body', ['name' => $data->name, 'email' => $data->email, 'message' => $data->message]));

            $mailer->send($email);

            $this->addFlash('success', $translator->trans('contact.flash.success'));

            return $this->redirectToRoute('page_contact');
        }

        return $this->render('pages/contact.html.twig', [
            'page' => $page,
            'form' => $form,
        ]);
    }
}

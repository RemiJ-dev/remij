<?php

declare(strict_types=1);

namespace App\Controller;

use App\Form\ContactType;
use App\Form\DTO\ContactDTO;
use App\Model\Page;
use Stenope\Bundle\ContentManagerInterface;
use Stenope\Bundle\Exception\ContentNotFoundException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Routing\Attribute\Route;
use Twig\Environment;

class DefaultController extends AbstractController
{
    public function __construct(
        private readonly ContentManagerInterface $contentManager,
        private readonly Environment $twig,
    ) {
    }

    #[Route('/', name: 'page_home')]
    public function home(): Response
    {
        return $this->render('pages/home.html.twig');
    }

    /**
     * @throws TransportExceptionInterface
     */
    #[Route('/contact', name: 'page_contact', methods: ['GET', 'POST'])]
    public function contact(Request $request, MailerInterface $mailer): Response
    {
        $page = $this->contentManager->getContent(Page::class, 'contact');

        $data = new ContactDTO();
        $form = $this->createForm(ContactType::class, $data);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $email = new Email()
                ->from('contact@remij.dev')
                ->to('bonjour@remij.dev')
                ->replyTo($data->email)
                ->subject('[Contact] ' . $data->subject)
                ->text(\sprintf("De : %s <%s>\n\n%s", $data->name, $data->email, $data->message));

            $mailer->send($email);

            $this->addFlash('success', 'Votre message a bien été envoyé. Je vous répondrai dès que possible !');

            return $this->redirectToRoute('page_contact');
        }

        return $this->render('pages/contact.html.twig', [
            'page' => $page,
            'form' => $form,
        ]);
    }

    /**
     * This route is used to display pages from `content/pages`.
     * Since this is a catch-all route, it has a very low priority.
     */
    #[Route('/{slug}', name: 'page_content', requirements: ['slug' => '[^\.]+'], priority: -500)]
    public function page(string $slug): Response
    {
        if ('home' === $slug) {
            return $this->redirectToRoute('page_home');
        }

        try {
            $page = $this->contentManager->getContent(Page::class, $slug);
        } catch (ContentNotFoundException $exception) {
            throw $this->createNotFoundException(\sprintf(
                'Page not found. Did you forget to create a `content/pages/%s.md` file?',
                $slug,
            ), $exception);
        }

        // You can create a custom template for each page, named after its slug,
        // (e.g: For "foo/bar.md" file => use "foo/bar.html.twig")
        // or use the generic "page.html.twig" one.
        $template = "pages/$slug.html.twig";
        if (!$this->twig->getLoader()->exists($template)) {
            $template = 'pages/page.html.twig';
        }

        return $this->render($template, ['page' => $page]);
    }
}

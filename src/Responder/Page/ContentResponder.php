<?php

declare(strict_types=1);

namespace App\Responder\Page;

use App\Domain\Page\Model\Page;
use App\Responder\AbstractTwigResponder;
use Symfony\Bundle\FrameworkBundle\Controller\ControllerHelper;
use Symfony\Component\DependencyInjection\Attribute\AutowireMethodOf;
use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

class ContentResponder extends AbstractTwigResponder
{
    public function __construct(
        #[AutowireMethodOf(ControllerHelper::class)]
        \Closure $render,
        private readonly Environment $twig,
    ) {
        parent::__construct($render);
    }

    /**
     * @throws RuntimeError
     * @throws SyntaxError
     * @throws LoaderError
     */
    public function __invoke(string $slug, Page $page): Response
    {
        $template = "pages/$slug.html.twig";
        if (!$this->twig->getLoader()->exists($template)) {
            $template = 'pages/page.html.twig';
        }

        return $this->render($template, ['page' => $page]);
    }
}

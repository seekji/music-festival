<?php

namespace App\Controller;

use App\Entity\Page;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class DefaultController
 * @package App\Controller
 */
class PageController extends AbstractController
{
    /**
     * @Route("/page-{slug}/", name="app.page")
     *
     * @param Request $request
     * @param Page $page
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function show(Request $request, Page $page)
    {
        if ($page->getLocale() !== $request->getLocale()) {
            throw $this->createNotFoundException();
        }

        $template = Page::TEMPLATES[$page->getTemplate()];

        return $this->render("page/{$template}.html.twig", ['page' => $page]);
    }
}

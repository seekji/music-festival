<?php

namespace App\Controller;

use App\Service\PartnerService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class DefaultController
 * @package App\Controller
 */
class DefaultController extends AbstractController
{

    /**
     * @var PartnerService
     */
    private $partnerService;

    /**
     * DefaultController constructor.
     * @param PartnerService $partnerService
     */
    public function __construct(PartnerService $partnerService)
    {
        $this->partnerService = $partnerService;
    }

    /**
     * @Route("/", name="app.homepage", options={"sitemap" = true})
     *
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction(Request $request)
    {
        dd($this->partnerService->getSortedPartners());

        return $this->render('default/index.html.twig', []);
    }
}

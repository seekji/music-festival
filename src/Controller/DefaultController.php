<?php

namespace App\Controller;

use App\Service\ArtistService;
use App\Service\NewsService;
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
     * @var ArtistService
     */
    private $artistService;

    /**
     * @var NewsService
     */
    private $newsService;

    /**
     * DefaultController constructor.
     * @param PartnerService $partnerService
     * @param ArtistService $artistService
     * @param NewsService $newsService
     */
    public function __construct(PartnerService $partnerService, ArtistService $artistService, NewsService $newsService)
    {
        $this->partnerService = $partnerService;
        $this->artistService = $artistService;
        $this->newsService = $newsService;
    }

    /**
     * @Route("/", name="app.homepage", options={"sitemap" = true})
     *
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction(Request $request)
    {
        return $this->render('default/index.html.twig', [
            'partners' => $this->partnerService->getSortedPartners(),
            'artists' => $this->artistService->artistRepository->findAll(),
            'news' => $this->newsService->getLastNewsByLocale($request->getLocale())
        ]);
    }
}

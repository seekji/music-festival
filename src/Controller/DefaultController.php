<?php

namespace App\Controller;

use App\Service\ArtistService;
use App\Service\NewsService;
use App\Service\PartnerService;
use App\Service\SliderService;
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
     * @var SliderService
     */
    private $sliderService;

    /**
     * DefaultController constructor.
     * @param PartnerService $partnerService
     * @param ArtistService $artistService
     * @param NewsService $newsService
     * @param SliderService $sliderService
     */
    public function __construct(
        PartnerService $partnerService,
        ArtistService $artistService,
        NewsService $newsService,
        SliderService $sliderService
    )
    {
        $this->partnerService = $partnerService;
        $this->artistService = $artistService;
        $this->newsService = $newsService;
        $this->sliderService = $sliderService;
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
            'artists' => $this->artistService->getArtistsByLocale($request->getLocale()),
            'news' => $this->newsService->getLastNewsByLocale($request->getLocale()),
            'slides' => $this->sliderService->getSlidesByLocale($request->getLocale())
        ]);
    }
}

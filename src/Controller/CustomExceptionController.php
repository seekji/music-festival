<?php

namespace App\Controller;

use App\Entity\Locale\LocaleInterface;
use App\Service\PartnerService;
use Symfony\Bundle\TwigBundle\Controller\ExceptionController;
use Symfony\Component\Debug\Exception\FlattenException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Log\DebugLoggerInterface;
use Symfony\Contracts\Translation\TranslatorInterface;
use Twig\Environment;

class CustomExceptionController extends ExceptionController
{

    private $partnerService;

    private $translator;

    public function __construct(PartnerService $partnerService, TranslatorInterface $translator, Environment $twig, bool $debug)
    {
        $this->partnerService = $partnerService;
        $this->translator = $translator;

        parent::__construct($twig, $debug);
    }

    public function showAction(Request $request, FlattenException $exception, DebugLoggerInterface $logger = null)
    {
        $currentContent = $this->getAndCleanOutputBuffering($request->headers->get('X-Php-Ob-Level', -1));
        $showException = $request->attributes->get('showException', $this->debug); // As opposed to an additional parameter, this maintains BC

        $code = $exception->getStatusCode();

        if (stristr($request->getRequestUri(), '/en/')) {
            $request->setLocale(LocaleInterface::LAN_EN);
            $this->translator->setLocale(LocaleInterface::LAN_EN);
        }

        return new Response($this->twig->render(
            (string)$this->findTemplate($request, $request->getRequestFormat(), $code, $showException),
            [
                'status_code' => $code,
                'status_text' => isset(Response::$statusTexts[$code]) ? Response::$statusTexts[$code] : '',
                'exception' => $exception,
                'logger' => $logger,
                'currentContent' => $currentContent,
                'partners' => $this->partnerService->getSortedPartners($request->getLocale()),
            ]
        ), 200, ['Content-Type' => $request->getMimeType($request->getRequestFormat()) ?: 'text/html']);
    }
}
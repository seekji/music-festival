<?php

namespace App\Twig;

use App\Service\MenuService;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;
use Twig\TwigFilter;

class MenuExtension extends AbstractExtension
{
    private $menuService;

    public function __construct(MenuService $menuService)
    {
        $this->menuService = $menuService;
    }

    /**
     * @return array|TwigFilter[]
     */
    public function getFunctions(): array
    {
        return [
            new TwigFunction('menuLinks', [$this, 'menuLinks']),
        ];
    }

    /**
     * @param int $location
     * @param string $locale
     * @return array
     */
    public function menuLinks(int $location, string $locale): array
    {
        return $this->menuService->getLinksByLocationAndLocale($location, $locale);
    }
}
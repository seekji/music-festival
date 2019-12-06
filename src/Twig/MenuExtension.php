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
    public function getFilters(): array
    {
        return [
            new TwigFilter('menuLinks', [$this, 'menuLinks']),
        ];
    }

    /**
     * @param int $location
     * @param int $locale
     * @return array
     */
    public function menuLinks(int $location, int $locale): array
    {
        $this->menuService->getLinksByLocationAndLocale($location, $locale);
    }
}
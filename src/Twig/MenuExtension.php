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
            new TwigFunction('columnMenuLinks', [$this, 'columnMenuLinks']),
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

    public function columnMenuLinks(int $location, string $locale): array
    {
        $links = $this->menuLinks($location, $locale);
        $linksByColumns = [];

        foreach ($links as $link) {
            $linksByColumns[$link->getColumnName()][] = $link;
        }

        return $linksByColumns;
    }
}
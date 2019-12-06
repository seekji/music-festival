<?php

namespace App\Service;

use App\Repository\MenuRepository;

class MenuService
{
    private $menuRepository;

    public function __construct(MenuRepository $menuRepository)
    {
        $this->menuRepository = $menuRepository;
    }

    public function getLinksByLocationAndLocale(int $location, string $locale): array
    {
        return $this->menuRepository->findBy(['locale' => $locale, 'location' => $location], ['sort' => 'ASC']);
    }
}
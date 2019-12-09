<?php

namespace App\Service;

use App\Repository\SliderRepository;

class SliderService
{
    private $sliderRepository;

    public function __construct(SliderRepository $sliderRepository)
    {
        $this->sliderRepository = $sliderRepository;
    }

    public function getSlidesByLocale(string $locale): array
    {
        return $this->sliderRepository->findBy(['locale' => $locale, 'isActive' => true], ['sort' => 'ASC']);
    }
}
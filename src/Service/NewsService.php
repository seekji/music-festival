<?php

namespace App\Service;

use App\Repository\NewsRepository;

class NewsService
{
    public const NEWS_COUNT = 2;

    private $newsRepository;

    public function __construct(NewsRepository $newsRepository)
    {
        $this->newsRepository = $newsRepository;
    }

    public function getLastNewsByLocale(string $locale): array
    {
        return $this->newsRepository->findBy(['locale' => $locale, 'isActive' => true], ['createdAt' => 'DESC'], self::NEWS_COUNT);
    }
}
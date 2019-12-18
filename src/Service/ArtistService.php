<?php

namespace App\Service;

use App\Repository\ArtistRepository;

/**
 * Class ArtistService
 * @package App\Service
 */
class ArtistService
{
    /**
     * @var ArtistRepository $artistRepository
     */
    public $artistRepository;

    /**
     * ArtistService constructor.
     * @param ArtistRepository $artistRepository
     */
    public function __construct(ArtistRepository $artistRepository)
    {
        $this->artistRepository = $artistRepository;
    }

    public function getArtistsByLocale(string $locale): array
    {
        return $this->artistRepository->findBy(['locale' => $locale], ['startAt' => 'ASC', 'isHeadliner' => 'ASC', 'sort' => 'ASC']);
    }
}
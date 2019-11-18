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
}
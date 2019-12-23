<?php

namespace App\Service;

use App\Repository\PartnerRepository;

class PartnerService
{
    private $partnerRepository;

    public function __construct(PartnerRepository $partnerRepository)
    {
        $this->partnerRepository = $partnerRepository;
    }

    public function getSortedPartners(string $locale): array
    {
        return $this->partnerRepository->findBy(['locale' => $locale], ['sort' => 'ASC', 'isBig' => 'DESC']);
    }
}


<?php

namespace App\Service;

use App\Repository\PartnerRepository;

/**
 * Class PartnerService
 * @package App\Service
 */
class PartnerService
{
    /**
     * @var PartnerRepository
     */
    private $partnerRepository;

    /**
     * PartnerService constructor.
     * @param PartnerRepository $partnerRepository
     */
    public function __construct(PartnerRepository $partnerRepository)
    {
        $this->partnerRepository = $partnerRepository;
    }

    /**
     * @return \App\Entity\Partner[]
     */
    public function getSortedPartners()
    {
        return $this->partnerRepository->findBy([], ['sort' => 'ASC', 'isBig' => 'DESC']);
    }
}


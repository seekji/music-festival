<?php

namespace App\Repository;

use App\Entity\ZoneLineup;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method ZoneLineup|null find($id, $lockMode = null, $lockVersion = null)
 * @method ZoneLineup|null findOneBy(array $criteria, array $orderBy = null)
 * @method ZoneLineup[]    findAll()
 * @method ZoneLineup[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ZoneLineupRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ZoneLineup::class);
    }

    // /**
    //  * @return ZoneLineup[] Returns an array of ZoneLineup objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('z')
            ->andWhere('z.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('z.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ZoneLineup
    {
        return $this->createQueryBuilder('z')
            ->andWhere('z.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}

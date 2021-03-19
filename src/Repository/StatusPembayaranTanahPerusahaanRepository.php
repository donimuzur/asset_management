<?php

namespace App\Repository;

use App\Entity\StatusPembayaranTanahPerusahaan;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method StatusPembayaranTanahPerusahaan|null find($id, $lockMode = null, $lockVersion = null)
 * @method StatusPembayaranTanahPerusahaan|null findOneBy(array $criteria, array $orderBy = null)
 * @method StatusPembayaranTanahPerusahaan[]    findAll()
 * @method StatusPembayaranTanahPerusahaan[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class StatusPembayaranTanahPerusahaanRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, StatusPembayaranTanahPerusahaan::class);
    }

    // /**
    //  * @return StatusPembayaranTanahPerusahaan[] Returns an array of StatusPembayaranTanahPerusahaan objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?StatusPembayaranTanahPerusahaan
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}

<?php

namespace App\Repository;

use App\Entity\StatusPembayaranBangunanPerusahaan;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method StatusPembayaranBangunanPerusahaan|null find($id, $lockMode = null, $lockVersion = null)
 * @method StatusPembayaranBangunanPerusahaan|null findOneBy(array $criteria, array $orderBy = null)
 * @method StatusPembayaranBangunanPerusahaan[]    findAll()
 * @method StatusPembayaranBangunanPerusahaan[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class StatusPembayaranBangunanPerusahaanRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, StatusPembayaranBangunanPerusahaan::class);
    }

    // /**
    //  * @return StatusPembayaranBangunanPerusahaan[] Returns an array of StatusPembayaranBangunanPerusahaan objects
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
    public function findOneBySomeField($value): ?StatusPembayaranBangunanPerusahaan
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

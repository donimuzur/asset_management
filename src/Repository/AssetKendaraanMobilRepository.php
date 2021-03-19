<?php

namespace App\Repository;

use App\Entity\AssetKendaraanMobil;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method AssetKendaraanMobil|null find($id, $lockMode = null, $lockVersion = null)
 * @method AssetKendaraanMobil|null findOneBy(array $criteria, array $orderBy = null)
 * @method AssetKendaraanMobil[]    findAll()
 * @method AssetKendaraanMobil[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AssetKendaraanMobilRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, AssetKendaraanMobil::class);
    }

    public function findMobilByManufacturer()
    {
        return $this->createQueryBuilder("a")
              ->select("a.Manufacturer, count(a.Manufacturer) as Total, 'Mobil' as GroupBy")
              ->groupBy('a.Manufacturer')
              ->getQuery()
              ->getResult();
    }

    // /**
    //  * @return AssetKendaraanMobil[] Returns an array of AssetKendaraanMobil objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?AssetKendaraanMobil
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}

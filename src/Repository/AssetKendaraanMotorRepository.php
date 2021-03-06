<?php

namespace App\Repository;

use App\Entity\AssetKendaraanMotor;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method AssetKendaraanMotor|null find($id, $lockMode = null, $lockVersion = null)
 * @method AssetKendaraanMotor|null findOneBy(array $criteria, array $orderBy = null)
 * @method AssetKendaraanMotor[]    findAll()
 * @method AssetKendaraanMotor[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AssetKendaraanMotorRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, AssetKendaraanMotor::class);
    }

    public function findMotorByManufacturer()
    {
        return $this->createQueryBuilder("a")
              ->select("a.Manfucaturer as Manufacturer, count(a.Manfucaturer) as Total")
              ->groupBy('a.Manfucaturer')
              ->getQuery()
              ->getResult();
    }

    // /**
    //  * @return AssetKendaraanMotor[] Returns an array of AssetKendaraanMotor objects
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
    public function findOneBySomeField($value): ?AssetKendaraanMotor
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

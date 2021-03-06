<?php

namespace App\Repository;

use App\Entity\AssetTanahPribadi;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method AssetTanahPribadi|null find($id, $lockMode = null, $lockVersion = null)
 * @method AssetTanahPribadi|null findOneBy(array $criteria, array $orderBy = null)
 * @method AssetTanahPribadi[]    findAll()
 * @method AssetTanahPribadi[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AssetTanahPribadiRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, AssetTanahPribadi::class);
    }

    // /**
    //  * @return AssetTanahPribadi[] Returns an array of AssetTanahPribadi objects
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
    public function findOneBySomeField($value): ?AssetTanahPribadi
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

<?php

namespace App\Repository;

use App\Entity\AssetUser;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method AssetUser|null find($id, $lockMode = null, $lockVersion = null)
 * @method AssetUser|null findOneBy(array $criteria, array $orderBy = null)
 * @method AssetUser[]    findAll()
 * @method AssetUser[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AssetUserRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, AssetUser::class);
    }

    // /**
    //  * @return AssetUser[] Returns an array of AssetUser objects
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
    public function findOneBySomeField($value): ?AssetUser
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

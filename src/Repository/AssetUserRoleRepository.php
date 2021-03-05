<?php

namespace App\Repository;

use App\Entity\AssetUserRole;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method AssetUserRole|null find($id, $lockMode = null, $lockVersion = null)
 * @method AssetUserRole|null findOneBy(array $criteria, array $orderBy = null)
 * @method AssetUserRole[]    findAll()
 * @method AssetUserRole[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AssetUserRoleRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, AssetUserRole::class);
    }

    // /**
    //  * @return AssetUserRole[] Returns an array of AssetUserRole objects
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
    public function findOneBySomeField($value): ?AssetUserRole
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

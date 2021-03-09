<?php

namespace App\Repository;

use App\Entity\AttachmentAssetTanahPribadi;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method AttachmentAssetTanahPribadi|null find($id, $lockMode = null, $lockVersion = null)
 * @method AttachmentAssetTanahPribadi|null findOneBy(array $criteria, array $orderBy = null)
 * @method AttachmentAssetTanahPribadi[]    findAll()
 * @method AttachmentAssetTanahPribadi[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AttachmentAssetTanahPribadiRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, AttachmentAssetTanahPribadi::class);
    }

    // /**
    //  * @return AttachmentAssetTanahPribadi[] Returns an array of AttachmentAssetTanahPribadi objects
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
    public function findOneBySomeField($value): ?AttachmentAssetTanahPribadi
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

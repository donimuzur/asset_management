<?php

namespace App\Repository;

use App\Entity\AttachmentAssetKendaraanMobil;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method AttachmentAssetKendaraanMobil|null find($id, $lockMode = null, $lockVersion = null)
 * @method AttachmentAssetKendaraanMobil|null findOneBy(array $criteria, array $orderBy = null)
 * @method AttachmentAssetKendaraanMobil[]    findAll()
 * @method AttachmentAssetKendaraanMobil[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AttachmentAssetKendaraanMobilRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, AttachmentAssetKendaraanMobil::class);
    }

    // /**
    //  * @return AttachmentAssetKendaraanMobil[] Returns an array of AttachmentAssetKendaraanMobil objects
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
    public function findOneBySomeField($value): ?AttachmentAssetKendaraanMobil
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

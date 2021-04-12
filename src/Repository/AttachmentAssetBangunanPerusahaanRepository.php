<?php

namespace App\Repository;

use App\Entity\AttachmentAssetBangunanPerusahaan;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method AttachmentAssetBangunanPerusahaan|null find($id, $lockMode = null, $lockVersion = null)
 * @method AttachmentAssetBangunanPerusahaan|null findOneBy(array $criteria, array $orderBy = null)
 * @method AttachmentAssetBangunanPerusahaan[]    findAll()
 * @method AttachmentAssetBangunanPerusahaan[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AttachmentAssetBangunanPerusahaanRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, AttachmentAssetBangunanPerusahaan::class);
    }

    // /**
    //  * @return AttachmentAssetBangunanPerusahaan[] Returns an array of AttachmentAssetBangunanPerusahaan objects
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
    public function findOneBySomeField($value): ?AttachmentAssetBangunanPerusahaan
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

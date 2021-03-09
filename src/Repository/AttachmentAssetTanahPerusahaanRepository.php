<?php

namespace App\Repository;

use App\Entity\AttachmentAssetTanahPerusahaan;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method AttachmentAssetTanahPerusahaan|null find($id, $lockMode = null, $lockVersion = null)
 * @method AttachmentAssetTanahPerusahaan|null findOneBy(array $criteria, array $orderBy = null)
 * @method AttachmentAssetTanahPerusahaan[]    findAll()
 * @method AttachmentAssetTanahPerusahaan[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AttachmentAssetTanahPerusahaanRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, AttachmentAssetTanahPerusahaan::class);
    }

    // /**
    //  * @return AttachmentAssetTanahPerusahaan[] Returns an array of AttachmentAssetTanahPerusahaan objects
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
    public function findOneBySomeField($value): ?AttachmentAssetTanahPerusahaan
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

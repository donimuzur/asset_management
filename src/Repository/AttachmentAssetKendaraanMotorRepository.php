<?php

namespace App\Repository;

use App\Entity\AttachmentAssetKendaraanMotor;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method AttachmentAssetKendaraanMotor|null find($id, $lockMode = null, $lockVersion = null)
 * @method AttachmentAssetKendaraanMotor|null findOneBy(array $criteria, array $orderBy = null)
 * @method AttachmentAssetKendaraanMotor[]    findAll()
 * @method AttachmentAssetKendaraanMotor[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AttachmentAssetKendaraanMotorRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, AttachmentAssetKendaraanMotor::class);
    }

    // /**
    //  * @return AttachmentAssetKendaraanMotor[] Returns an array of AttachmentAssetKendaraanMotor objects
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
    public function findOneBySomeField($value): ?AttachmentAssetKendaraanMotor
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

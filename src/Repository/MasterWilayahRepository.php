<?php

namespace App\Repository;

use App\Entity\MasterWilayah;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method MasterWilayah|null find($id, $lockMode = null, $lockVersion = null)
 * @method MasterWilayah|null findOneBy(array $criteria, array $orderBy = null)
 * @method MasterWilayah[]    findAll()
 * @method MasterWilayah[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MasterWilayahRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, MasterWilayah::class);
    }

    
    public function getProvinsiList()
    {
        return $this->createQueryBuilder('a')
            ->andWhere('LENGTH(a.kode) = 2')
            ->orderBy('a.nama', 'ASC')
            ->getQuery()
            ->getResult()
        ;
    }
    
    public function getMadyaList($provinsiId)
    {
        return $this->createQueryBuilder('a')
            ->where('a.kode like :val')
            ->andWhere('LENGTH(a.kode) = 5')
            ->setParameter('val',$provinsiId.'.%')
            ->orderBy('a.nama', 'ASC')
            ->getQuery()
            ->getResult()
        ;
    }

    public function getKecamatanList($madyaId)
    {
        return $this->createQueryBuilder('a')
            ->where('a.kode like :val')
            ->andWhere('LENGTH(a.kode) = 8')
            ->setParameter('val',$madyaId.'.%')
            ->orderBy('a.nama', 'ASC')
            ->getQuery()
            ->getResult()
        ;
    }

    public function getDesaList($kecId)
    {
        return $this->createQueryBuilder('a')
            ->where('a.kode like :val')
            ->setParameter('val', $kecId.'.%')
            ->orderBy('a.nama', 'ASC')
            ->getQuery()
            ->getResult()
        ;
    }
    // /**
    //  * @return MasterWilayah[] Returns an array of MasterWilayah objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('m.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?MasterWilayah
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}

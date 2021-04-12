<?php

namespace App\Repository;

use App\Entity\AssetBangunanPerusahaan;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method AssetBangunanPerusahaan|null find($id, $lockMode = null, $lockVersion = null)
 * @method AssetBangunanPerusahaan|null findOneBy(array $criteria, array $orderBy = null)
 * @method AssetBangunanPerusahaan[]    findAll()
 * @method AssetBangunanPerusahaan[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AssetBangunanPerusahaanRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, AssetBangunanPerusahaan::class);
    }
    
    public function findFilterAll($desa){
        return $this->createQueryBuilder("a")
              ->where('a.desa = :val')
              ->setParameter('val', $desa)
              ->getQuery()
              ->getResult();
    }

    public function getLuasanPerDesa()
    {
        return $this->createQueryBuilder("a")
              ->select("a.desa as Desa, sum(a.luasan) as Total, 'Perusahaan' as GroupBy ")
              ->groupBy('a.desa')
              ->getQuery()
              ->getResult();
    }

    public function getDataDesaList()
    {
        return $this->createQueryBuilder("a")
              ->select("DISTINCT  a.desa as Desa")
              ->getQuery()
              ->getResult();
    }

    public function findAllSorted()
    {
        return $this->createQueryBuilder("a")
              ->orderBy('a.desa')
              ->getQuery()
              ->getResult();
    }

    // /**
    //  * @return AssetBangunanPerusahaan[] Returns an array of AssetBangunanPerusahaan objects
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
    public function findOneBySomeField($value): ?AssetBangunanPerusahaan
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

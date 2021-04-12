<?php

namespace App\Repository;

use App\Entity\AssetBangunanPribadi;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method AssetBangunanPribadi|null find($id, $lockMode = null, $lockVersion = null)
 * @method AssetBangunanPribadi|null findOneBy(array $criteria, array $orderBy = null)
 * @method AssetBangunanPribadi[]    findAll()
 * @method AssetBangunanPribadi[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AssetBangunanPribadiRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, AssetBangunanPribadi::class);
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
              ->select("a.desa as Desa, sum(a.luasan) as Total, 'Pribadi' as GroupBy ")
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
    //  * @return AssetBangunanPribadi[] Returns an array of AssetBangunanPribadi objects
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
    public function findOneBySomeField($value): ?AssetBangunanPribadi
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

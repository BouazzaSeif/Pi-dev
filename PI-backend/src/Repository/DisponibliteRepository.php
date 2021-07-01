<?php

namespace App\Repository;

use App\Entity\Disponiblite;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Disponiblite|null find($id, $lockMode = null, $lockVersion = null)
 * @method Disponiblite|null findOneBy(array $criteria, array $orderBy = null)
 * @method Disponiblite[]    findAll()
 * @method Disponiblite[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DisponibliteRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Disponiblite::class);
    }

    // /**
    //  * @return Disponiblite[] Returns an array of Disponiblite objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('d.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Disponiblite
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}

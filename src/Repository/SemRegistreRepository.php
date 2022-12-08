<?php

namespace App\Repository;

use App\Entity\SemRegistre;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method SemRegistre|null find($id, $lockMode = null, $lockVersion = null)
 * @method SemRegistre|null findOneBy(array $criteria, array $orderBy = null)
 * @method SemRegistre[]    findAll()
 * @method SemRegistre[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SemRegistreRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, SemRegistre::class);
    }

    // /**
    //  * @return SemRegistre[] Returns an array of SemRegistre objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?SemRegistre
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}

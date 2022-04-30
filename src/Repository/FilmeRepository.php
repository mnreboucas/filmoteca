<?php

namespace App\Repository;

use App\Entity\Filme;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Filme|null find($id, $lockMode = null, $lockVersion = null)
 * @method Filme|null findOneBy(array $criteria, array $orderBy = null)
 * @method Filme[]    findAll()
 * @method Filme[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FilmeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Filme::class);
    }

    /**
     * @return Filme[] Returns an array of Premio objects
     */
    public function findAll()
    {
        return $this->findBy([],[
            'titulo' => 'ASC'
        ]);
    }

    // /**
    //  * @return Filme[] Returns an array of Filme objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('f.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Filme
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}

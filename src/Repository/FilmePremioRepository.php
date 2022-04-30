<?php

namespace App\Repository;

use App\Entity\FilmePremio;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method FilmePremio|null find($id, $lockMode = null, $lockVersion = null)
 * @method FilmePremio|null findOneBy(array $criteria, array $orderBy = null)
 * @method FilmePremio[]    findAll()
 * @method FilmePremio[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FilmePremioRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, FilmePremio::class);
    }
    

    // /**
    //  * @return FilmePremio[] Returns an array of FilmePremio objects
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
    public function findOneBySomeField($value): ?FilmePremio
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

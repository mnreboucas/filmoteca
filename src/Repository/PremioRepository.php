<?php

namespace App\Repository;

use App\Entity\Premio;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Premio|null find($id, $lockMode = null, $lockVersion = null)
 * @method Premio|null findOneBy(array $criteria, array $orderBy = null)
 * @method Premio[]    findAll()
 * @method Premio[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PremioRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Premio::class);
    }

    /**
     * @return Premio[] Returns an array of Premio objects
     */
    public function findAll()
    {
        return $this->findBy([],[
            'descricao' => 'ASC'
        ]);
    }

    /*
    public function findOneBySomeField($value): ?Premio
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}

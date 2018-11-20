<?php

namespace App\Repository;

use App\Entity\RapportVisite;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method RapportVisite|null find($id, $lockMode = null, $lockVersion = null)
 * @method RapportVisite|null findOneBy(array $criteria, array $orderBy = null)
 * @method RapportVisite[]    findAll()
 * @method RapportVisite[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RapportVisiteRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, RapportVisite::class);
    }

    // /**
    //  * @return RapportVisite[] Returns an array of RapportVisite objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('r.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?RapportVisite
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}

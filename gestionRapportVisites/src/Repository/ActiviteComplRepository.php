<?php

namespace App\Repository;

use App\Entity\ActiviteCompl;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method ActiviteCompl|null find($id, $lockMode = null, $lockVersion = null)
 * @method ActiviteCompl|null findOneBy(array $criteria, array $orderBy = null)
 * @method ActiviteCompl[]    findAll()
 * @method ActiviteCompl[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ActiviteComplRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, ActiviteCompl::class);
    }

    /**
     * @Return Retourne une liste d'activite
     */
    public function findManyByText($search)     
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.lieu LIKE :search')
            ->orWhere('a.theme LIKE :search')
            ->setParameter('search', '%'.$search.'%')
            ->getQuery()
            ->getResult();
    }
    // /**
    //  * @return ActiviteCompl[] Returns an array of ActiviteCompl objects
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
    public function findOneBySomeField($value): ?ActiviteCompl
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

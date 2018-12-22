<?php

namespace App\Repository;

use App\Entity\Medicament;
use App\Repository\AbstractRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

/**
 * @method Medicament|null find($id, $lockMode = null, $lockVersion = null)
 * @method Medicament|null findOneBy(array $criteria, array $orderBy = null)
 * @method Medicament[]    findAll()
 * @method Medicament[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MedicamentRepository extends AbstractRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Medicament::class);
    }

    /**
     * @Return Retourne une liste de médicament
     */
    public function findManyByText($search)     
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.libelle LIKE :search')
            ->orWhere('m.med_depot_legal LIKE :search')
            ->setParameter('search', '%'.$search.'%')
            ->getQuery()
            ->getResult();
        }
    public function findByDate($search)     
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.date_ajout= :search')
            ->setParameter('search', $search)
            ->getQuery()
            ->getResult();
    }

    public function findCritere($search=null, $searchDate=null)     
    {
        
        $datefr =  \DateTime::createFromFormat('d/m/Y', $searchDate);
        $searchDate =  $datefr ? $datefr->format('Y-m-d') : date('d/m/Y');
        dump($search);
        dump($searchDate);
        $maRequete=$this->createQueryBuilder('m');

        if($searchDate != null  ) {
            $maRequete= $maRequete  ->andWhere('m.date_ajout= :datesearch')
                                    ->setParameter('datesearch', $searchDate);
        }
        $maRequete=     $maRequete  ->andWhere('m.libelle LIKE :search or m.med_depot_legal LIKE :search')
                                    
                                    ->setParameter('search','%' .$search. '%')
                                    ->getQuery()
                                    ->getResult();
     
            return $maRequete;
    } 

    public function search($limit = 20, $offset = 0)
    {
        $qb = $this->createQueryBuilder('m')
                   ->select('m');
        return $this->paginate($qb, $limit, $offset);
    }
    

    // /**
    //  * @return Medicament[] Returns an array of Medicament objects
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
    public function findOneBySomeField($value): ?Medicament
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

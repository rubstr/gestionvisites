<?php

namespace App\Repository;

use App\Entity\Medicament;
use Pagerfanta\Pagerfanta;
use Doctrine\ORM\QueryBuilder;
use Doctrine\ORM\EntityRepository;
use Pagerfanta\Adapter\DoctrineORMAdapter;
use Symfony\Bridge\Doctrine\RegistryInterface;
use WhiteOctober\PagerfantaBundle\WhiteOctoberPagerfantaBundle;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

abstract class AbstractRepository extends ServiceEntityRepository
{
    
    protected function paginate(QueryBuilder $qb, $limit = 20, $offset = 0)
    {
        
        if (0 == $limit || 0 == $offset) {
            throw new \LogicException('$limit & $offstet must be greater than 0.');
        }
        
        $pager = new Pagerfanta(new DoctrineORMAdapter($qb));
        $currentPage = $offset;
        $pager->setCurrentPage($currentPage);
        $pager->setMaxPerPage((int) $limit);
        
        return $pager;
    }
}
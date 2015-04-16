<?php

namespace Apm\AccountBundle\Entity;

use Doctrine\ORM\EntityRepository;

class AccountRepository extends EntityRepository
{
    public function findSubdomain($subdomain)
    {
        $qb = $this->createQueryBuilder('a')
                   ->where('a.subdomain = :subdomain')
                   ->setParameter('subdomain', $subdomain)
                   ->setMaxResults(1)
                   ;
        
        return $qb->getQuery()
                  ->getSingleResult();
    }
    
    public function connectionMaxvalue()
    {
        $qb = $this->createQueryBuilder('a')
                   ->orderBy('a.connection', 'DESC')
                   ->setMaxResults(1)
                   ;
        
        return $qb->getQuery()
                  ->getOneOrNullResult();
    }
}

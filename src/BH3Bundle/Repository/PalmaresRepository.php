<?php

namespace BH3Bundle\Repository;

/**
 * PalmaresRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class PalmaresRepository extends \Doctrine\ORM\EntityRepository
{
    public function getByDate()
    {
        $qb = $this->createQueryBuilder('p')
            ->orderBy('p.datetime', 'DESC');
        
        return $qb->getQuery()->getResult();
    }
}

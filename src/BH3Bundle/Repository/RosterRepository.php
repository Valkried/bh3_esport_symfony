<?php

namespace BH3Bundle\Repository;

/**
 * RosterRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class RosterRepository extends \Doctrine\ORM\EntityRepository
{
    public function getLoisir()
    {
        return $this->findOneBy(array('id' => 4));
    }
}

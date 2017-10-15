<?php

namespace BH3Bundle\Repository;

/**
 * MembreRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class MembreRepository extends \Doctrine\ORM\EntityRepository
{
    public function getStaff()
    {
        return $this->findBy(
            array('staff' => true),
            array('position' => 'ASC')
        );
    }

    public function getAll()
    {
        return $this->findBy(
            array(),
            array('position' => 'ASC')
        );
    }
}

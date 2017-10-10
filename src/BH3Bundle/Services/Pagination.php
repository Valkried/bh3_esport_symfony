<?php

namespace BH3Bundle\Services;

use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class Pagination
{

    private $listElt;
    private $listPages;

    public function setParameters($nbElt, $order, $sorting, $repository, $currentPage, $criteria = null, $criteriaValue = null)
    {
        $offset = ($currentPage - 1) * $nbElt;

        if ($criteria && $criteriaValue)
        {
            $this->listElt = $repository->findBy(
                array($criteria => $criteriaValue),
                array($order => $sorting),
                $nbElt, $offset);
        }

        else
        {
            $this->listElt = $repository->findBy(
                array(),
                array($order => $sorting),
                $nbElt, $offset);
        }

        $this->listPages = ceil(count($repository->findAll()) / $nbElt);

        if ($currentPage < 1 || $currentPage > $this->listPages)
        {
            throw new NotFoundHttpException('La page demandée n\'existe pas');
        }

        return $this;
    }

    public function getElements()
    {
        return $this->listElt;
    }

    public function getPages()
    {
        return $this->listPages;
    }

}
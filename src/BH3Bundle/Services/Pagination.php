<?php

namespace BH3Bundle\Services;

use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class Pagination
{

    private $nbElt;
    private $repository;
    private $currentPage;

    public function getList($nbElt, $order, $sorting, $repository, $currentPage, $criteria = null, $criteriaValue = null)
    {

        $this->nbElt = $nbElt;
        $this->repository = $repository;
        $this->currentPage = $currentPage;

        if ($this->currentPage < 1)
        {
            throw new NotFoundHttpException('La page demandée n\'existe pas');
        }

        $offset = ($currentPage - 1) * $nbElt;

        if ($criteria)
        {
            return $repository->findBy(
                array($criteria => $criteriaValue),
                array($order => $sorting),
                $nbElt, $offset);
        }

        else
        {
            return $repository->findBy(
                array(),
                array($order => $sorting),
                $nbElt, $offset);
        }

    }

    public function getPages()
    {
        $listPages = ceil(count($this->repository->findAll()) / $this->nbElt);

        if ($this->currentPage > $listPages)
        {
            throw new NotFoundHttpException('La page demandée n\'existe pas');
        }

        return $listPages;
    }

}
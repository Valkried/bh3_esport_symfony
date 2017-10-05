<?php

namespace BH3Bundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

class AdminController extends Controller
{
    /**
     * @Route("/admin/news", name="admin_news")
     * @Method({"GET", "POST"})
     */
    public function newsAction()
    {

    }

    /**
     * @Route("/admin/membres", name="admin_membres")
     * @Method({"GET", "POST"})
     */
    public function membresAction()
    {

    }

    /**
     * @Route("/admin/messagerie", name="admin_messagerie")
     * @Method({"GET", "POST"})
     */
    public function messagerieAction()
    {

    }

    /**
     * @Route("/admin/rosters", name="admin_rosters")
     * @Method({"GET", "POST"})
     */
    public function rostersAction()
    {

    }

    /**
     * @Route("/admin/palmares", name="admin_palmares")
     * @Method({"GET", "POST"})
     */
    public function palmaresAction()
    {

    }

    /**
     * @Route("/admin/partenaires", name="admin_partenaires")
     * @Method({"GET", "POST"})
     */
    public function partenairesAction()
    {

    }
}

<?php

namespace BH3Bundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

class AdminController extends Controller
{
    /**
     * @Route("/admin/news", name="admin_news")
     * @Method("GET")
     */
    public function newsAction()
    {
        if (!$this->get('security.authorization_checker')->isGranted('ROLE_REDACTEUR'))
        {
            throw new AccessDeniedException('Accès limité au rédacteur et aux administrateurs');
        }


    }

    /**
     * @Route("/admin/membres", name="admin_membres")
     * @Method("GET")
     */
    public function membresAction()
    {
        if (!$this->get('security.authorization_checker')->isGranted('ROLE_MANAGER'))
        {
            throw new AccessDeniedException('Accès limité aux managers et administrateurs');
        }
    }

    /**
     * @Route("/admin/messagerie", name="admin_messagerie")
     * @Method("GET")
     */
    public function messagerieAction()
    {
        if (!$this->get('security.authorization_checker')->isGranted('ROLE_ADMIN'))
        {
            throw new AccessDeniedException('Accès limité aux administrateurs');
        }
    }

    /**
     * @Route("/admin/rosters", name="admin_rosters")
     * @Method("GET")
     */
    public function rostersAction()
    {
        if (!$this->get('security.authorization_checker')->isGranted('ROLE_ADMIN'))
        {
            throw new AccessDeniedException('Accès limité aux administrateurs');
        }
    }

    /**
     * @Route("/admin/palmares", name="admin_palmares")
     * @Method("GET")
     */
    public function palmaresAction()
    {
        if (!$this->get('security.authorization_checker')->isGranted('ROLE_ADMIN'))
        {
            throw new AccessDeniedException('Accès limité aux administrateurs');
        }
    }

    /**
     * @Route("/admin/partenaires", name="admin_partenaires")
     * @Method("GET")
     */
    public function partenairesAction()
    {
        if (!$this->get('security.authorization_checker')->isGranted('ROLE_ADMIN'))
        {
            throw new AccessDeniedException('Accès limité aux administrateurs');
        }
    }
}

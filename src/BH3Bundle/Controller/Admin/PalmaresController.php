<?php

namespace BH3Bundle\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpFoundation\File\File;
use BH3Bundle\Entity\Roster;
use BH3Bundle\Form\Type\RosterType;

class PalmaresController extends Controller
{
    /**
     * @Route("/admin/palmares", name="admin_palmares")
     * @Method("GET")
     */
    public function palmaresAction()
    {
        return $this->render('BH3Bundle:Admin:palmares.html.twig');
    }
}

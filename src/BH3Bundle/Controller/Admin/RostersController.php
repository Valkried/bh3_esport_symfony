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

class RostersController extends Controller
{
    /**
     * @Route("/admin/rosters", name="admin_rosters")
     * @Method("GET")
     */
    public function rostersAction()
    {
        return $this->render('BH3Bundle:Admin:rosters.html.twig');
    }
}

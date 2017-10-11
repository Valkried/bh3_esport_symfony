<?php

namespace BH3Bundle\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpFoundation\File\File;
use BH3Bundle\Entity\Partenaire;
use BH3Bundle\Form\Type\PartenaireType;

class PartenairesController extends Controller
{
    /**
     * @Route("/admin/partenaires", name="admin_partenaires")
     * @Method("GET")
     */
    public function partenairesAction()
    {
        return $this->render('BH3Bundle:Admin:partenaires.html.twig');
    }
}

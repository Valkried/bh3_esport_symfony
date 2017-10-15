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

class MessagerieController extends Controller
{
    /**
     * @Route("/admin/messagerie", name="admin_messagerie")
     * @Method("GET")
     */
    public function messagerieAction()
    {
        $listEmails = $this->getDoctrine()->getManager()->getRepository('BH3Bundle:Email')->findBy(array(), array('date' => 'DESC'));

        return $this->render('BH3Bundle:Admin:messagerie.html.twig', array(
            'emails' => $listEmails
        ));
    }
}

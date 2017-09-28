<?php

namespace BH3Bundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class CoreController extends Controller
{
    /**
     * @Route("/", name="home")
     */
    public function indexAction()
    {
        return $this->render('BH3Bundle:Public:index.html.twig');
    }

    /**
     * @Route("/presentation", name="presentation")
     */
    public function presentationAction()
    {
        return $this->render('BH3Bundle:Public:presentation.html.twig');
    }

    /**
     * @Route("/staff", name="staff")
     */
    public function staffAction()
    {
        return $this->render('BH3Bundle:Public:staff.html.twig');
    }

    /**
     * @Route("/palmares", name="palmares")
     */
    public function palmaresAction()
    {
        return $this->render('BH3Bundle:Public:palmares.html.twig');
    }

    /**
     * @Route("/roster/{id}", name="roster")
     */
    public function rosterAction($id)
    {
        return $this->render('BH3Bundle:Public:roster.html.twig', array(
            'roster' => $id
        ));
    }

    /**
     * @Route("/partenaires", name="partenaires")
     */
    public function partenairesAction()
    {
        return $this->render('BH3Bundle:Public:partenaires.html.twig');
    }

    /**
     * @Route("/livestream", name="livestream")
     */
    public function livestreamAction()
    {
        return $this->render('BH3Bundle:Public:livestream.html.twig');
    }

    /**
     * @Route("/contact", name="contact")
     */
    public function contactAction()
    {
        return $this->render('BH3Bundle:Public:contact.html.twig');
        
    }
}

<?php

namespace BH3Bundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class PublicController extends Controller
{
    /**
     * @Route("/{page}", name="home", requirements={"page" = "\d+"}, defaults={"page" = 1})
     */
    public function indexAction($page)
    {
        $repository = $this->getDoctrine()->getManager()->getRepository('BH3Bundle:News');

        $limit = 3; // Nombre de news à afficher par page
        
        $offset = ($page - 1) * $limit;
        $nbPages = ceil(count($repository->findAll()) / $limit);

        if ($page > $nbPages)
        {
            throw new NotFoundHttpException('La page demandée n\'existe pas');
        }

        $listNews = $repository->getAllNews($offset, $limit);

        return $this->render('BH3Bundle:Public:index.html.twig', array(
            'news' => $listNews,
            'nbPages' => $nbPages,
            'currentPage' => $page
        ));
    }

    public function menuAction()
    {
        $listRosters = $this->getDoctrine()->getManager()->getRepository('BH3Bundle:Roster')->findAll();

        return $this->render('BH3Bundle:Public:menu.html.twig', array(
            'rosters' => $listRosters
        ));
    }

    /**
     * @Route("/news/{id}", name="news", requirements={"id" = "\d+"})
     */
    public function newsAction($id)
    {
        $news = $this->getDoctrine()->getManager()->getRepository('BH3Bundle:News')->find($id);

        if ($news === null) {
            throw new NotFoundHttpException('La page demandée n\'existe pas');
        }

        return $this->render('BH3Bundle:Public:news.html.twig', array(
            'news' => $news
        ));
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
        $listStaff = $this->getDoctrine()->getManager()->getRepository('BH3Bundle:Membre')->getStaff();

        return $this->render('BH3Bundle:Public:staff.html.twig', array(
            'staff' => $listStaff
        ));
    }

    /**
     * @Route("/palmares", name="palmares")
     */
    public function palmaresAction()
    {
        $listPalmares = $this->getDoctrine()->getManager()->getRepository('BH3Bundle:Palmares')->getByDate();

        return $this->render('BH3Bundle:Public:palmares.html.twig', array(
            'palmares' => $listPalmares
        ));
    }

    /**
     * @Route("/roster/{url}", name="roster")
     */
    public function rosterAction($url)
    {
        $roster = $this->getDoctrine()->getManager()->getRepository('BH3Bundle:Roster')->findBy(array('url' => $url));

        return $this->render('BH3Bundle:Public:roster.html.twig', array(
            'roster' => $roster
        ));
    }

    /**
     * @Route("/partenaires", name="partenaires")
     */
    public function partenairesAction()
    {
        $listPartenaires = $this->getDoctrine()->getManager()->getRepository('BH3Bundle:Partenaire')->findAll();

        return $this->render('BH3Bundle:Public:partenaires.html.twig', array(
            'partenaires' => $listPartenaires
        ));
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

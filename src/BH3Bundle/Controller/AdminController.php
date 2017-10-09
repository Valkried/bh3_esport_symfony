<?php

namespace BH3Bundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use BH3Bundle\Entity\News;
use BH3Bundle\Form\Type\NewsType;

class AdminController extends Controller
{
    /**
     * @Route("/admin/news/{page}", name="admin_news", requirements={"page" = "\d+"}, defaults={"page" = 1})
     * @Method({"GET", "POST"})
     */
    public function newsAction(Request $request, $page)
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

        $new = new News;
        $form = $this->createForm(NewsType::class, $new);

        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid())
        {
            $em = $this->getDoctrine()->getManager();
            $em->persist($new);
            $em->flush();

            return $this->redirectToRoute('admin_news');
        }
        
        return $this->render('BH3Bundle:Admin:news.html.twig', array(
            'form' => $form->createView(),
            'news' => $listNews,
            'nbPages' => $nbPages,
            'currentPage' => $page
        ));
    }

    /**
     * @Route("/admin/news/edit/{id}", name="admin_news_edit", requirements={"id" = "\d+"})
     * @Method("GET")
     */
    public function newsEditAction()
    {

    }

    /**
     * @Route("/admin/membres", name="admin_membres")
     * @Method("GET")
     */
    public function membresAction()
    {
        return $this->render('BH3Bundle:Admin:membres.html.twig');
    }

    /**
     * @Route("/admin/messagerie", name="admin_messagerie")
     * @Method("GET")
     */
    public function messagerieAction()
    {
        return $this->render('BH3Bundle:Admin:messagerie.html.twig');
    }

    /**
     * @Route("/admin/rosters", name="admin_rosters")
     * @Method("GET")
     */
    public function rostersAction()
    {
        return $this->render('BH3Bundle:Admin:rosters.html.twig');
    }

    /**
     * @Route("/admin/palmares", name="admin_palmares")
     * @Method("GET")
     */
    public function palmaresAction()
    {
        return $this->render('BH3Bundle:Admin:palmares.html.twig');
    }

    /**
     * @Route("/admin/partenaires", name="admin_partenaires")
     * @Method("GET")
     */
    public function partenairesAction()
    {
        return $this->render('BH3Bundle:Admin:partenaires.html.twig');
    }
}

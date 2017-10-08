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
     * @Route("/admin/news", name="admin_news")
     * @Method({"GET", "POST"})
     */
    public function newsAction(Request $request)
    {
        if (!$this->get('security.authorization_checker')->isGranted('ROLE_REDACTEUR'))
        {
            throw new AccessDeniedException('Accès limité au rédacteur et aux administrateurs');
        }

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
            'form' => $form->createView()
        ));
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

        return $this->render('BH3Bundle:Admin:membres.html.twig');
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

        return $this->render('BH3Bundle:Admin:messagerie.html.twig');
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

        return $this->render('BH3Bundle:Admin:rosters.html.twig');
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

        return $this->render('BH3Bundle:Admin:palmares.html.twig');
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

        return $this->render('BH3Bundle:Admin:partenaires.html.twig');
    }
}

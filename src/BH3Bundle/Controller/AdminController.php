<?php

namespace BH3Bundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use BH3Bundle\Entity\News;
use BH3Bundle\Form\Type\NewsType;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;

class AdminController extends Controller
{
    /**
     * @Route("/admin/news/{page}", name="admin_news", requirements={"page" = "\d+"}, defaults={"page" = 1})
     * @Method({"GET", "POST"})
     */
    public function newsAction(Request $request, $page)
    {
        $repository = $this->getDoctrine()->getManager()->getRepository('BH3Bundle:News');

        // Paramètres : limite, page actuelle, repository, tri, ordre, critère de sélection (opt), valeur du critère (opt)
        $pagination = $this->get('bh3.pagination')->setParameters(3, $page, $repository, 'date', 'DESC');

        $new = new News;
        $form = $this->createForm(NewsType::class, $new);

        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid())
        {
            $picture = $new->getPicture();

            $pictureName = md5(uniqid()).'.'.$picture->guessExtension();

            $picture->move($this->getParameter('img_directory').'/news', $pictureName);

            $new->setPicture($pictureName);

            $new->setAuthor($this->get('security.token_storage')->getToken()->getUser());

            $em = $this->getDoctrine()->getManager();
            $em->persist($new);
            $em->flush();

            return $this->redirectToRoute('admin_news');
        }
        
        return $this->render('BH3Bundle:Admin:news.html.twig', array(
            'form' => $form->createView(),
            'news' => $pagination->getElements(),
            'nbPages' => $pagination->getPages(),
            'currentPage' => $page
        ));
    }

    /**
     * @Route("/admin/news/edit/{id}", name="admin_news_edit", requirements={"id" = "\d+"})
     * @Method("GET")
     */
    public function newsEditAction($id)
    {
        $new = $this->getDoctrine()->getManager()->getRepository('BH3Bundle:News')->find($id);
        $new->setPicture(new File($this->getParameter('img_directory').'/news//'.$new->getPicture()));

        $form = $this->createForm(NewsType::class, $new);
        $form->add('published', CheckboxType::class);

        return $this->render('BH3Bundle:Admin:news_edit.html.twig', array(
            'form' => $form->createView()
        ));
    }

    /**
     * @Route("/admin/news/delete/{id}", name="admin_news_delete", requirements={"id" = "\d+"})
     * Method("GET")
     */
    public function newsDeleteAction($id)
    {
        $new = $this->getDoctrine()->getManager()->getRepository('BH3Bundle:News')->find($id);

        $fs = new FileSystem();
        $fs->remove($this->getParameter('img_directory').'/news//'.$new->getPicture());

        $em = $this->getDoctrine()->getManager();
        $em->remove($new);
        $em->flush();

        return $this->redirectToRoute('admin_news');
    }

    /**
     * @Route("/admin/news/visibility/{id}", name="admin_news_visibility", requirements={"id" = "\d+"})
     */
    public function newsVisibilityAction($id)
    {
        $new = $this->getDoctrine()->getManager()->getRepository('BH3Bundle:News')->find($id);

        ($new->getPublished() === true) ? $new->setPublished(false) : $new->setPublished(true);

        $this->getDoctrine()->getManager()->flush();

        return $this->redirectToRoute('admin_news');
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

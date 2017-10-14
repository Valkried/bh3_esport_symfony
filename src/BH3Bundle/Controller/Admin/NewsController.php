<?php

namespace BH3Bundle\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpFoundation\File\File;
use BH3Bundle\Entity\News;
use BH3Bundle\Form\Type\NewsType;

class NewsController extends Controller
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
            $uploader = $this->get('bh3.uploadimg')->upload($new, 'news');
            
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
     * @Method({"GET", "POST"})
     */
    public function newsEditAction(Request $request, $id)
    {
        $new = $this->getDoctrine()->getManager()->getRepository('BH3Bundle:News')->find($id);
        $oldPicture = $new->getPicture();
        $new->setPicture(new File($this->getParameter('img_directory').'/news//'.$new->getPicture()));

        $form = $this->createForm(NewsType::class, $new);
        $form->add('published', CheckboxType::class, array('required' => false));

        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid())
        {
            if (!$new->getPicture()) {
                $new->setPicture($oldPicture);
            } else {
                $uploader = $this->get('bh3.uploadimg')->upload($new, 'news');

                $fs = new FileSystem();
                $fs->remove($this->getParameter('img_directory').'/news//'.$oldPicture);
            }

            $em = $this->getDoctrine()->getManager();
            $em->persist($new);
            $em->flush();

            if (!$new->getPublished()) {
                return $this->redirectToRoute('admin_news_edit', array('id' => $id));
            } else {
                return $this->redirectToRoute('home');
            }
        }

        return $this->render('BH3Bundle:Admin:news_edit.html.twig', array(
            'form' => $form->createView(),
            'news' => $new,
            'oldPicture' => $oldPicture
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
}

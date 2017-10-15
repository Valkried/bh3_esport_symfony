<?php

namespace BH3Bundle\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpFoundation\File\File;
use BH3Bundle\Entity\Membre;
use BH3Bundle\Form\Type\MembreType;

class MembresController extends Controller
{
    /**
     * @Route("/admin/membres", name="admin_membres")
     * @Method({"GET", "POST"})
     */
    public function membresAction(Request $request)
    {
        $membre = new Membre;
        $form = $this->createForm(MembreType::class, $membre);

        $listMembres = $this->getDoctrine()->getManager()->getRepository('BH3Bundle:Membre')->findAll();

        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid())
        {
            if (!$membre->getPicture()) {
                $membre->setPicture('tete-bh3.png');
            } else {
                $this->get('bh3.uploadimg')->upload($membre, 'membres');
            }

            $em = $this->getDoctrine()->getManager();
            $em->persist($membre);
            $em->flush();

            return $this->redirectToRoute('admin_membres');
        }

        return $this->render('BH3Bundle:Admin:membres.html.twig', array(
            'form' => $form->createView(),
            'membres' => $listMembres
        ));
    }

    /**
     * @Route("/admin/membres/edit/{id}", name="admin_membres_edit", requirements={"id" = "\d+"})
     * @Method({"GET", "POST"})
     */
    public function membresEditAction(Request $request, $id)
    {
        $membre = $this->getDoctrine()->getManager()->getRepository('BH3Bundle:Membre')->find($id);
        $oldPicture = $membre->getPicture();
        $membre->setPicture(new File($this->getParameter('img_directory').'/membres//'.$membre->getPicture()));

        $form = $this->createForm(MembreType::class, $membre);

        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid())
        {
            if (!$membre->getPicture()) {
                $membre->setPicture($oldPicture);
            } else {
                $this->get('bh3.uploadimg')->upload($membre, 'membres');

                $fs = new FileSystem();
                $fs->remove($this->getParameter('img_directory').'/membres//'.$oldPicture);
            }

            $em = $this->getDoctrine()->getManager();
            $em->flush();

            return $this->redirectToRoute('admin_membres');
        }

        return $this->render('BH3Bundle:Admin:membre_edit.html.twig', array(
            'form' => $form->createView(),
            'membre' => $membre
        ));
    }

    /**
     * @Route("/admin/membres/delete/{id}", name="admin_membres_delete", requirements={"id" = "\d+"})
     * Method("GET")
     */
    public function membresDeleteAction($id)
    {
        $membre = $this->getDoctrine()->getManager()->getRepository('BH3Bundle:Membre')->find($id);

        if ($membre->getPicture() !== 'tete-bh3.png') {
            $fs = new FileSystem();
            $fs->remove($this->getParameter('img_directory').'/membres//'.$membre->getPicture());
        }

        $em = $this->getDoctrine()->getManager();
        $em->remove($membre);
        $em->flush();

        return $this->redirectToRoute('admin_membres');
    }
}

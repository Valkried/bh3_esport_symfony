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
     * @Method({"GET", "POST"})
     */
    public function partenairesAction(Request $request)
    {
        $partenaire = new Partenaire;
        $form = $this->createForm(PartenaireType::class, $partenaire);

        $partenairesList = $this->getDoctrine()->getManager()->getRepository('BH3Bundle:Partenaire')->findAll();

        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid())
        {
            $this->get('bh3.uploadimg')->upload($partenaire, 'partenaires');

            $em = $this->getDoctrine()->getManager();
            $em->persist($partenaire);
            $em->flush();

            $this->redirectToRoute('admin_partenaires');
        }

        return $this->render('BH3Bundle:Admin:partenaires.html.twig', array(
            'form' => $form->createView(),
            'partenaires' => $partenairesList
        ));
    }

    /**
     * @Route("/admin/partenaires/delete/{id}", name="admin_partenaires_delete", requirements={"id" = "\d+"})
     * @Method({"GET", "POST"})
     */
    public function partenairesDeleteAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $partenaire = $em->getRepository('BH3Bundle:Partenaire')->find($id);

        $fs = new FileSystem();
        $fs->remove($this->getParameter('img_directory').'/partenaires//'.$partenaire->getPicture());

        $em->remove($partenaire);
        $em->flush();

        return $this->redirectToRoute('admin_partenaires');
    }
}

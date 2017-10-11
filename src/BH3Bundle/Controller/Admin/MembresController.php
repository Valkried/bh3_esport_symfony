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
                $picture = $membre->getPicture();
                $pictureName = $membre->getPseudo().'.'.$picture->guessExtension();
                $picture->move($this->getParameter('img_directory').'/membres', $pictureName);
                $membre->setPicture($pictureName);
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
}

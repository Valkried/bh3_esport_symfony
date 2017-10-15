<?php

namespace BH3Bundle\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;
use BH3Bundle\Entity\Palmares;
use BH3Bundle\Form\Type\PalmaresType;

class PalmaresController extends Controller
{
    /**
     * @Route("/admin/palmares", name="admin_palmares")
     * @Method({"GET", "POST"})
     */
    public function palmaresAction(Request $request)
    {
        $palmares = new Palmares();
        $form = $this->createForm(PalmaresType::class, $palmares);

        $palmaresList = $this->getDoctrine()->getManager()->getRepository('BH3Bundle:Palmares')->getByDate();

        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid())
        {
            //$palmares->setPicture($palmares->getPicture().'.png');

            $em = $this->getDoctrine()->getManager();
            $em->persist($palmares);
            $em->flush();

            return $this->redirectToRoute('admin_palmares');
        }

        return $this->render('BH3Bundle:Admin:palmares.html.twig', array(
            'form' => $form->createView(),
            'palmaresList' => $palmaresList
        ));
    }

    /**
     * @Route("/admin/palmares/delete/{id}", name="admin_palmares_delete", requirements={"id" = "\d+"})
     * @Method({"GET", "POST"})
     */
    public function palmaresDeleteAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $palmares = $em->getRepository('BH3Bundle:Palmares')->find($id);

        $em->remove($palmares);
        $em->flush();

        return $this->redirectToRoute('admin_palmares');
    }
}

<?php

namespace BH3Bundle\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpFoundation\File\File;
use BH3Bundle\Entity\Roster;
use BH3Bundle\Form\Type\RosterType;

class RostersController extends Controller
{
    /**
     * @Route("/admin/rosters", name="admin_rosters")
     * @Method({"GET", "POST"})
     */
    public function rostersAction(Request $request)
    {
        $rosters = $this->getDoctrine()->getManager()->getRepository('BH3Bundle:Roster')->findAll();

        $roster = new Roster;
        $form = $this->createForm(RosterType::class, $roster);

        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid())
        {
            $uploader = $this->get('bh3.uploadimg')->upload($roster, 'rosters');

            $em = $this->getDoctrine()->getManager();
            $em->persist($roster);
            $em->flush();

            return $this->redirectToRoute('admin_rosters');
        }
        
        return $this->render('BH3Bundle:Admin:rosters.html.twig', array(
            'form' => $form->createView(),
            'rosters' => $rosters
        ));
    }

    /**
     * @Route("/admin/rosters/edit/{id}", name="admin_rosters_edit", requirements={"id" = "\d+"})
     * @Method({"GET", "POST"})
     */
    public function rostersEditAction(Request $request, $id)
    {
        $roster = $this->getDoctrine()->getManager()->getRepository('BH3Bundle:Roster')->find($id);
        $oldPicture = $roster->getPicture();
        $roster->setPicture(new File($this->getParameter('img_directory').'/rosters//'.$roster->getPicture()));

        $form = $this->createForm(RosterType::class, $roster);

        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid())
        {
            if (!$roster->getPicture()) {
                $roster->setPicture($oldPicture);
            } else {
                $uploader = $this->get('bh3.uploadimg')->upload($roster, 'rosters');

                $fs = new FileSystem();
                $fs->remove($this->getParameter('img_directory').'/rosters//'.$oldPicture);
            }

            $em = $this->getDoctrine()->getManager();
            $em->persist($roster);
            $em->flush();

            return $this->redirectToRoute('admin_rosters');
        }

        return $this->render('BH3Bundle:Admin:roster_edit.html.twig', array(
            'form' => $form->createView(),
            'roster' => $roster,
            'oldPicture' => $oldPicture
        ));
    }

    /**
     * @Route("/admin/rosters/delete/{id}", name="admin_rosters_delete", requirements={"id" = "\d+"})
     * Method("GET")
     */
    public function rostersDeleteAction($id)
    {
        $repository = $this->getDoctrine()->getManager()->getRepository('BH3Bundle:Roster');

        $roster = $repository->find($id);

        $fs = new FileSystem();
        $fs->remove($this->getParameter('img_directory').'/rosters//'.$roster->getPicture());

        $membres = $roster->getMembres();

        if (!empty($membres)) {
            $loisir = $repository->getLoisir();

            foreach ($membres as $membre)
            {
                $membre->setRoster($loisir);
            }
        }

        $em = $this->getDoctrine()->getManager();
        $em->remove($roster);
        $em->flush();

        return $this->redirectToRoute('admin_rosters');
    }
}

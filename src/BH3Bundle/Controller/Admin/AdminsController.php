<?php

namespace BH3Bundle\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;
use BH3Bundle\Form\Type\UserType;

class AdminsController extends Controller
{
    /**
     * @Route("/admin/admins", name="admin_admins")
     * @Method("GET")
     */
    public function adminsAction()
    {
        $listAdmins = $this->getDoctrine()->getManager()->getRepository('BH3Bundle:User')->findAll();

        return $this->render('BH3Bundle:Admin:admins.html.twig', array(
            'admins' => $listAdmins
        ));
    }

    /**
     * @Route("/admin/admins/role", name="admin_admins_role")
     * @Method("POST")
     */
    public function roleAction(Request $request)
    {
        if ($request->isXmlHttpRequest()) {
            $admin = $this->getDoctrine()->getManager()->getRepository('BH3Bundle:User')->find($request->request->get('id'));
            $admin->setRoles(array($request->request->get('role')));
    
            $this->getDoctrine()->getManager()->flush();
        }

        return $this->redirectToRoute('admin_admins');
    }

    /**
     * @Route("/admin/admins/delete/{id}", name="admin_admins_delete", requirements={"id" = "\d+"})
     * @Method({"GET", "POST"})
     */
    public function deleteAction($id)
    {
        $admin = $this->getDoctrine()->getManager()->getRepository('BH3Bundle:User')->find($id);

        $em = $this->getDoctrine()->getManager();
        $em->remove($admin);
        $em->flush();

        return $this->redirectToRoute('admin_admins');
    }
}

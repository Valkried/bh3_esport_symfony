<?php

namespace BH3Bundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpFoundation\Request;
use BH3Bundle\Entity\Email;
use BH3Bundle\Form\Type\ContactType;

class PublicController extends Controller
{
    /**
     * @Route("/{page}", name="home", requirements={"page" = "\d+"}, defaults={"page" = 1})
     * @Method("GET")
     */
    public function indexAction($page)
    {
        $repository = $this->getDoctrine()->getManager()->getRepository('BH3Bundle:News');

        // Paramètres : limite, page actuelle, repository, tri, ordre, critère de sélection (opt), valeur du critère (opt)
        $pagination = $this->get('bh3.pagination')->setParameters(3, $page, $repository, 'date', 'DESC', 'published', true);

        return $this->render('BH3Bundle:Public:index.html.twig', array(
            'news' => $pagination->getElements(),
            'nbPages' => $pagination->getPages(),
            'currentPage' => $page
        ));
    }

    public function menuAction()
    {
        $listRosters = $this->getDoctrine()->getManager()->getRepository('BH3Bundle:Roster')->findAll();

        return $this->render('BH3Bundle:Public:menu.html.twig', array(
            'rosters' => $listRosters
        ));
    }

    /**
     * @Route("/news/{id}", name="news", requirements={"id" = "\d+"})
     * @Method("GET")
     */
    public function newsAction($id)
    {
        $news = $this->getDoctrine()->getManager()->getRepository('BH3Bundle:News')->find($id);

        if ($news === null) {
            throw new NotFoundHttpException('La page demandée n\'existe pas');
        }

        return $this->render('BH3Bundle:Public:news.html.twig', array(
            'news' => $news
        ));
    }

    /**
     * @Route("/presentation", name="presentation")
     * @Method("GET")
     */
    public function presentationAction()
    {
        return $this->render('BH3Bundle:Public:presentation.html.twig');
    }

    /**
     * @Route("/staff", name="staff")
     * @Method("GET")
     */
    public function staffAction()
    {
        $listStaff = $this->getDoctrine()->getManager()->getRepository('BH3Bundle:Membre')->getStaff();

        return $this->render('BH3Bundle:Public:staff.html.twig', array(
            'staff' => $listStaff
        ));
    }

    /**
     * @Route("/palmares", name="palmares")
     * @Method("GET")
     */
    public function palmaresAction()
    {
        $listPalmares = $this->getDoctrine()->getManager()->getRepository('BH3Bundle:Palmares')->getByDate();

        return $this->render('BH3Bundle:Public:palmares.html.twig', array(
            'palmares' => $listPalmares
        ));
    }

    /**
     * @Route("/roster/{url}", name="roster")
     * @Method("GET")
     */
    public function rosterAction($url)
    {
        $roster = $this->getDoctrine()->getManager()->getRepository('BH3Bundle:Roster')->findOneBy(array('url' => $url));

        if (!$roster)
        {
            throw new NotFoundHttpException('Ce roster n\'existe pas');
        }

        return $this->render('BH3Bundle:Public:roster.html.twig', array(
            'roster' => $roster
        ));
    }

    /**
     * @Route("/partenaires", name="partenaires")
     * @Method("GET")
     */
    public function partenairesAction()
    {
        $listPartenaires = $this->getDoctrine()->getManager()->getRepository('BH3Bundle:Partenaire')->findAll();

        return $this->render('BH3Bundle:Public:partenaires.html.twig', array(
            'partenaires' => $listPartenaires
        ));
    }

    /**
     * @Route("/livestream", name="livestream")
     * @Method("GET")
     */
    public function livestreamAction()
    {
        return $this->render('BH3Bundle:Public:livestream.html.twig');
    }

    /**
     * @Route("/contact", name="contact")
     * @Method({"GET", "POST"})
     */
    public function contactAction(Request $request)
    {
        $email = new Email;
        $contactForm = $this->createForm(ContactType::class, $email);

        if ($request->isMethod('POST') && $contactForm->handleRequest($request)->isValid())
        {
            $em = $this->getDoctrine()->getManager();
            $em->persist($email);
            $em->flush();

            $message = (new \Swift_Message($email->getSubject().' | Contact BH3'))
                ->setFrom($email->getEmail())
                ->setTo('burningheads@live.fr')
                ->setBody(
                    $this->renderView('Emails/contact.html.twig',
                        array(
                            'name' => $email->getName(),
                            'subject' => $email->getSubject(),
                            'email' => $email->getEmail(),
                            'content' => $email->getContent(),
                            'date' => $email->getDate()
                        )
                    ), 'text/html')
                ->addPart(
                    $this->renderView('Emails/contact.html.twig',
                        array(
                            'name' => $email->getName(),
                            'subject' => $email->getSubject(),
                            'email' => $email->getEmail(),
                            'content' => $email->getContent(),
                            'date' => $email->getDate()
                        )
                    ), 'text/plain');

            $this->get('mailer')->send($message);

            $request->getSession()->getFlashbag()->add('info', 'Votre message a bien été envoyé !');

            return $this->redirectToRoute('home');
        }

        return $this->render('BH3Bundle:Public:contact.html.twig', array(
            'contactForm' => $contactForm->createView()
        ));
    }
}

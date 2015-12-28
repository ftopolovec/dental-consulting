<?php

namespace dc\ContentBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use dc\ContentBundle\Form\ContactType;

class DefaultController extends Controller
{
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $blog = $em->getRepository('dcContentBundle:Blog')->findAll();
        $course = $em->getRepository('dcContentBundle:Course')->findAll();

        $form = $this->createForm(new ContactType());

        if ($request->isMethod('POST')) {
            $form->submit($request);

            if ($form->isValid()) {
                $message = \Swift_Message::newInstance()
                    ->setSubject($form->get('predmet')->getData())
                    ->setFrom($form->get('email')->getData())
                    ->setTo('ftopolovec2@gmail.com')
                    ->setBody(
                        $this->renderView(
                            'dcContentBundle:Default:kontakt_forma.html.twig',
                            array(
                                'ip' => $request->getClientIp(),
                                'ime' => $form->get('ime')->getData(),
                                'poruka' => $form->get('poruka')->getData(),

                            )
                        )
                    );

                $this->get('mailer')->send($message);

                $request->getSession()->getFlashBag()->add('success', 'Uspješno ste poslali email! Hvala Vam!');

                return $this->redirect($this->generateUrl('dc_content_homepage'));
            }
        }



        return $this->render('dcContentBundle:Default:index.html.twig', array(
            "blog" => $blog,
            "course" => $course,
            'form' => $form->createView()
        ));
    }

    public function displayAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $blog = $em->getRepository('dcContentBundle:Blog')->find($id);
        $otherblogs = $em->getRepository('dcContentBundle:Blog')->findAll();

        return $this->render('dcContentBundle:Default:display.html.twig', array(
            "blog" => $blog,
            "otherblogs" => $otherblogs
        ));
    }

    public function displaycourseAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $course = $em->getRepository('dcContentBundle:Course')->find($id);

        return $this->render('dcContentBundle:Default:displaycourse.html.twig', array(
            "course" => $course
        ));
    }

}

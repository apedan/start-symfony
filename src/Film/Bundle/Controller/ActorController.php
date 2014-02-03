<?php

namespace Film\Bundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Film\Bundle\Form\ActorForm;
use Film\Bundle\Entity\Actor;

class ActorController extends Controller
{
    /**
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function actorsAction()
    {
        $em = $this->getDoctrine()->getManager();
        $actors = $em->getRepository('Film\Bundle\Entity\Actor')->findAll();

        return $this->render('FilmBundle:Actor:actors.html.twig', array(
            'actors' => $actors,
        ));
    }

    /**
     * Create actor form, submit form, create actor
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function createAction()
    {
        $request = $this->getRequest();
        $em = $this->getDoctrine()->getManager();
        $actor = new Actor();
        $form = $this->createForm(new ActorForm(), $actor, array(
            'action' => $this->generateUrl('actor_create'),
            'method' => 'POST',
        ));

        if ('POST' == $request->getMethod()) {
            $form->handleRequest($request);
            if ($form->isValid()) {
                $em->persist($actor);
                $em->flush();
                $this->get('session')->getFlashBag()->add(
                    'notice',
                    'Your actor was saved!'
                );

                return $this->redirect($this->generateUrl('actor_homepage'));
            }
        }

        return $this->render('FilmBundle:Actor:form.html.twig', array(
            'form' => $form->createView(),
        ));
    }
}

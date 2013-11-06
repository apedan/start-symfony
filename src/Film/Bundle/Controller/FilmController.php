<?php

namespace Film\Bundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Film\Bundle\Form\FilmForm;
use Film\Bundle\Entity\Film;

class FilmController extends Controller
{
    /**
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function filmsAction()
    {
        $em = $this->getDoctrine()->getManager();
        $films = $em->getRepository('Film\Bundle\Entity\Film')->findAll();
        return $this->render('FilmBundle:Film:films.html.twig', array(
            'films' => $films,
        ));
    }

    /**
     * Create film form, submit form, create film
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function createAction()
    {
        $request = $this->getRequest();
        $em = $this->getDoctrine()->getManager();
        $film = new Film();
        $form = $this->createForm(new FilmForm(), $film, array(
            'action' => $this->generateUrl('film_create'),
            'method' => 'POST',
        ));

        if($request->getMethod() == 'POST'){
            $form->handleRequest($request);

            if ($form->isValid()) {
                $em->persist($film);
                $em->flush();

                $this->get('session')->getFlashBag()->add(
                    'notice',
                    'Your film was saved!'
                );
                return $this->redirect($this->generateUrl('film_homepage'));
            }
        }

        return $this->render('FilmBundle:Film:form.html.twig', array(
            'form' => $form->createView(),
        ));
    }
}

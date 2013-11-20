<?php

namespace Film\Bundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Film\Bundle\Form\FilmForm;
use Film\Bundle\Entity\Film;
use Film\Bundle\FilmService;

class FilmController extends Controller
{
    /**
     * @return FilmService
     */
    protected  function getFilmService()
    {
        return $this->get('filmService');
    }

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function filmsAction()
    {
        return $this->render('FilmBundle:Film:films.html.twig', array(
            'films' => $this->getFilmService()->getFilms(),
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

        if ('POST' == $request->getMethod()) {
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

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function searchFilmsAction()
    {
        $requestParams = $this->getRequest()->query->all();
        try {
            $films = $this->getFilmService()->getFilmsByParams($requestParams);
        } catch (\Exception $e){
            $films = "Wrong query";
        }

        return $this->render('FilmBundle:Film:films.html.twig', array(
            'params' => $requestParams,
            'films' => $films,
        ));
    }
}

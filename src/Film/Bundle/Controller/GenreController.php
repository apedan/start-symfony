<?php

namespace Film\Bundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Film\Bundle\Form\GenreForm;
use Film\Bundle\Entity\Genre;

class GenreController extends Controller
{
    /**
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function genresAction()
    {
        $em = $this->getDoctrine()->getManager();
        $genres = $em->getRepository('Film\Bundle\Entity\Genre')->findAll();

        return $this->render('FilmBundle:Genre:genres.html.twig', array(
            'genres' => $genres,
        ));
    }

    /**
     * Create genre form, submit form, create genre
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function createAction()
    {
        $request = $this->getRequest();
        $em = $this->getDoctrine()->getManager();
        $genre = new Genre();
        $form = $this->createForm(new GenreForm(), $genre, array(
            'action' => $this->generateUrl('genre_create'),
            'method' => 'POST',
        ));
        if ('POST' == $request->getMethod()) {
            $form->handleRequest($request);
            if ($form->isValid()) {
                $em->persist($genre);
                $em->flush();
                $this->get('session')->getFlashBag()->add(
                    'notice',
                    'Your genre was saved!'
                );

                return $this->redirect($this->generateUrl('genre_homepage'));
            }
        }

        return $this->render('FilmBundle:Genre:form.html.twig', array(
            'form' => $form->createView(),
        ));
    }
}

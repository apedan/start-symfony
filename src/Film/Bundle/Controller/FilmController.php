<?php

namespace Film\Bundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class FilmController extends Controller
{
    public function filmsAction()
    {
        $filmService = $this->get('film_service');

        return $this->render('FilmBundle:Film:films.html.twig', array(
            'films' => $filmService->getFilms(),
        ));
    }
}

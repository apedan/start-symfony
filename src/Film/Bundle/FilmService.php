<?php

namespace Film\Bundle;

use Film\Bundle\Entity\FilmRepository;

class FilmService
{
    /**
     * @var Entity\FilmRepository
     */
    private $filmRepository;

    function __construct(FilmRepository $filmRepository)
    {
        $this->filmRepository = $filmRepository;
    }

    public function getFilms()
    {
        return $this->filmRepository->findAll();
    }

    public function getFilmsByParams(Array $params)
    {
        return $this->filmRepository->getFilmsByParams($params);
    }
}

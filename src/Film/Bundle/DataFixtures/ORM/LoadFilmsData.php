<?php

namespace Film\Bundle\DataFixtures\ORM;

use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Film\Bundle\Entity\Category;
use Film\Bundle\Entity\Actor;
use Film\Bundle\Entity\Film;
use Film\Bundle\Entity\Genre;

class LoadFilmsData implements FixtureInterface, ContainerAwareInterface
{
    protected $categoryManager;
    protected $actorManager;
    protected $genreManager;

    public function setContainer(ContainerInterface $container = null)
    {
        $this->categoryManager = $container->get('category.repository');
        $this->actorManager = $container->get('actor.repository');
        $this->genreManager = $container->get('genre.repository');
    }

    public function load(ObjectManager $manager)
    {
        $this->loadCategories($manager);
        $this->loadActors($manager);
        $this->loadGenres($manager);
        $this->loadFilms($manager);
    }

    protected function loadCategories($manager)
    {
        $categories = array(
            'Документальный',
            'Мультфильм',
            'Сериал',
            'Художественный',
            'Мультсериал',
            'Телепрограмма',
            'Спорт',
            'Музыка',
        );

        foreach ($categories as $title) {
            $category = new Category();
            $category->setTitle($title);
            $manager->persist($category);
        }

        $manager->flush();
    }

    protected function loadGenres($manager)
    {
        $genres = array(
            'Боевик',
            'Вестерн',
            'Детектив',
            'Драма',
            'Комедия',
            'Мелодрама',
            'Триллер',
            'Ужасы',
            'Фантастика',
            'Фентези',
        );

        foreach ($genres as $title) {
            $genre = new Genre();
            $genre->setTitle($title);
            $manager->persist($genre);
        }

        $manager->flush();
    }

    protected function loadActors($manager)
    {
        $actor = new Actor();
        $actor->setName('Джейми Фокс');
        $actor->setBirthDate(new \DateTime('2008-11-13'));
        $manager->persist($actor);

        $actor = new Actor();
        $actor->setName('Том Круз');
        $actor->setBirthDate(new \DateTime('1962-06-02'));
        $manager->persist($actor);

        $actor = new Actor();
        $actor->setName('Квентин Тарантино');
        $actor->setBirthDate(new \DateTime('1963-05-12'));
        $manager->persist($actor);

        $actor = new Actor();
        $actor->setName('Мартин Фриман');
        $actor->setBirthDate(new \DateTime('1971-09-10'));
        $manager->persist($actor);

        $actor = new Actor();
        $actor->setName('Джейсон Стэйтем');
        $actor->setBirthDate(new \DateTime('1967-09-12'));
        $manager->persist($actor);

        $actor = new Actor();
        $actor->setName('Дэниэл Крэйг');
        $actor->setBirthDate(new \DateTime('1968-03-02'));
        $manager->persist($actor);

        $actor = new Actor();
        $actor->setName('Дженнифер Гарнер');
        $actor->setBirthDate(new \DateTime('1972-04-17'));
        $manager->persist($actor);

        $manager->flush();
    }

    protected function loadFilms($manager)
    {
        $film = new Film();
        $film->setTitle('Джек Ричер');
        $film->setReleaseWorldAt(new \DateTime('2013-04-20'));
        $film->setDescription('По роману «Выстрел» британского писателя Ли Чайлда. Снайпер убивает пять случайных прохожих, но все улики указывают на человека, заключенного под стражу. На допросе подозреваемый умоляет об одном - найти Джека Ричера.');
        $film->setCategory($this->categoryManager->findOneBy(array('id' => 1)));

        $actor = $this->actorManager->findOneBy(array('id' => 1));
        $film->getActors()->add($actor);

        $genre = $this->genreManager->findOneBy(array('id' => 1));
        $film->getGenres()->add($genre);

        $manager->persist($film);

        $manager->flush();
    }
}

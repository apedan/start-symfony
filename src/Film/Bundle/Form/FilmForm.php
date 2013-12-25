<?php

namespace Film\Bundle\Form;

use Doctrine\Tests\ORM\Tools\Pagination\Category;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Film\Bundle\Form\DataTransformer\ActorsToArrayCollection;

class FilmForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('title');
        $builder->add('description', 'textarea');
//        $builder->add('category', 'entity', array(
//            'class'     => 'Film\Bundle\Entity\Category',
//            'property'  => 'title',
//        ));
        $builder->add('genres', 'entity', array(
            'class'     => 'Film\Bundle\Entity\Genre',
            'property'  => 'title',
            'multiple'  => true,
            'expanded'  => true,
        ));

//        $builder->add('actors', 'entity', array(
//            'class'     => 'Film\Bundle\Entity\Actor',
//            'property'  => 'name',
//            'multiple'  => true,
//        ));

        $entityManager = $options['em'];
        $transformer = new ActorsToArrayCollection($entityManager);

        $builder->add(
            $builder->create('actors', 'collection', array(
                'type'         => new ActorForm(),
                'allow_add'    => true,
                'allow_delete' => true,
                'prototype'    => true,
            ))->addModelTransformer($transformer)
        );

//        $builder->add('actors', 'collection', array(
//            'type'         => new ActorForm(),
//            'allow_add'    => true,
//            'allow_delete' => true,
//            'prototype'    => true,
//        ));

        $builder->add('category', new CategoryForm());

        $builder->add('submit', 'submit');
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver
            ->setDefaults(array(
            'data_class'            => 'Film\Bundle\Entity\Film',
            'cascade_validation'    => true,
            ))
            ->setRequired(array(
                'em',
            ))
            ->setAllowedTypes(array(
                'em' => 'Doctrine\Common\Persistence\ObjectManager',
            ));
    }

    public function getName()
    {
        return 'film';
    }
}
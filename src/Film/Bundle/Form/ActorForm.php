<?php

namespace Film\Bundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ActorForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('name');
        $builder->add('birthDate', 'date', array(
            'input'  => 'datetime',
            'widget' => 'choice',
        ));
        $builder->add('submit', 'submit');
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Film\Bundle\Entity\Actor',
            'cascade_validation' => true,
        ));
    }

    public function getName()
    {
        return 'actor';
    }
}
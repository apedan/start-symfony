<?php
/**
 * Created by JetBrains PhpStorm.
 * User: demetrius
 * Date: 10/29/13
 * Time: 5:45 PM
 * To change this template use File | Settings | File Templates.
 */

namespace Learn\Bundle\GBookBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class PostForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('title');
        $builder->add('text', 'textarea');
    }

    public function getName()
    {
        return 'post';
    }
}
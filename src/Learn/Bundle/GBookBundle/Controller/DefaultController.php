<?php

namespace Learn\Bundle\GBookBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Learn\Bundle\GBookBundle\Form\PostForm;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('GBookBundle:Default:index.html.twig', array('name' => $name));
    }

    public function createAction()
    {
        $form = $this->createForm(new PostForm(), array());
        return $this->render('GBookBundle:Default:create.html.twig', array('form' => $form->createView()));
    }
}

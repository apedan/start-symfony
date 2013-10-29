<?php

namespace Learn\Bundle\GBookBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('GBookBundle:Default:index.html.twig', array('name' => $name));
    }
}

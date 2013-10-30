<?php

namespace Learn\Bundle\GBookBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Learn\Bundle\GBookBundle\Form\PostForm;
use Learn\Bundle\GBookBundle\Entity\Post;

class DefaultController extends Controller
{
    /**
     * Create post form, submit form, create post
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function createAction()
    {
        $request = $this->getRequest();
        $em = $this->getDoctrine()->getManager();
        $form = $this->createForm(new PostForm(), array(), array(
            'action' => $this->generateUrl('g_book_create_post'),
            'method' => 'POST',
        ));

        if($request->getMethod() == 'POST'){
            $form->handleRequest($request);

            if ($form->isValid()) {

                $formData = $form->getData();
                $post = new Post();
                $post->setTheme($formData['theme']);
                $post->setText($formData['text']);
                $em->persist($post);
                $em->flush();

                $this->get('session')->getFlashBag()->add(
                    'notice',
                    'Your post was saved!'
                );
                return $this->redirect($this->generateUrl('g_book_homepage'));
            }

        }
        return $this->render('GBookBundle:Default:create.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    /**
     * All posts action
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function postsAction()
    {
        $em = $this->getDoctrine()->getManager();

        return $this->render('GBookBundle:Default:posts.html.twig', array(
            'posts' => $em->getRepository('Learn\Bundle\GBookBundle\Entity\Post')->findAll()
        ));
    }

    /**
     * Home page action
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction()
    {
        return $this->render('GBookBundle:Default:index.html.twig');
    }
}

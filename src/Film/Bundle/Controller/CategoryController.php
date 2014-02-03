<?php

namespace Film\Bundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Film\Bundle\Form\CategoryForm;
use Film\Bundle\Entity\Category;

class CategoryController extends Controller
{
    /**
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function categoriesAction()
    {
        $em = $this->getDoctrine()->getManager();
        $categories = $em->getRepository('Film\Bundle\Entity\Category')->findAll();

        return $this->render('FilmBundle:Category:categories.html.twig', array(
            'categories' => $categories,
        ));
    }

    /**
     * Create category form, submit form, create category
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function createAction()
    {
        $request = $this->getRequest();
        $em = $this->getDoctrine()->getManager();
        $category = new Category();
        $form = $this->createForm(new CategoryForm(), $category, array(
            'action' => $this->generateUrl('category_create'),
            'method' => 'POST',
        ));
        if ('POST' == $request->getMethod()) {
            $form->handleRequest($request);
            if ($form->isValid()) {
                $em->persist($category);
                $em->flush();
                $this->get('session')->getFlashBag()->add(
                    'notice',
                    'Your category was saved!'
                );

                return $this->redirect($this->generateUrl('category_homepage'));
            }
        }

        return $this->render('FilmBundle:Category:form.html.twig', array(
            'form' => $form->createView(),
        ));
    }
}

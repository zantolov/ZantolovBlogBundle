<?php

namespace Zantolov\BlogBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Zantolov\BlogBundle\Entity\Post;

/**
 * Blog controller.
 *
 * @Route("/")
 */
class BlogController extends Controller
{

    /**
     * @Route("/", name="blog.index")
     * @Method("GET")
     * @Template()
     */
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $postsQuery = $em->getRepository('ZantolovBlogBundle:Post')->getActivePosts();

        $paginator = $this->get('knp_paginator');
        $posts = $paginator->paginate(
            $postsQuery,
            $request->query->getInt('page', 1), // page number,
            10 // limit per page
        );

        return array(
            'posts' => $posts,
        );
    }


    /**
     * @param Request $request
     * @param $categoryId
     *
     * @Route("/c/{categoryId}", name="blog.category.index")
     * @Method("GET")
     * @Template()
     */
    public function categoryPostsAction(Request $request, $categoryId)
    {
        $em = $this->getDoctrine()->getManager();
        $category = $em->getRepository('ZantolovBlogBundle:Category')->findActive($categoryId);
        if (empty($category)) {
            throw new NotFoundHttpException();
        }

        $postsQuery = $em->getRepository('ZantolovBlogBundle:Post')->getPostsByCategory($category, array('sortByDate' => true));

        $paginator = $this->get('knp_paginator');
        $posts = $paginator->paginate(
            $postsQuery,
            $request->query->getInt('page', 1), // page number,
            10 // limit per page
        );

        return array(
            'posts'    => $posts,
            'category' => $category,
        );
    }
}

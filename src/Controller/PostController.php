<?php

namespace Zantolov\BlogBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Zantolov\AppBundle\Controller\EntityCrudController;
use Zantolov\BlogBundle\Entity\Post;

/**
 * Post controller.
 *
 * @Route("/post")
 */
class PostController extends EntityCrudController
{

    protected function getEntityClass()
    {
        return 'ZantolovBlogBundle:Post';
    }


    /**
     * Lists all Post entities.
     *
     * @Route("/", name="blog.admin.post")
     * @Method("GET")
     * @Template()
     */
    public function indexAction(Request $request)
    {
        return parent::baseIndexAction($request);
    }

    /**
     * Creates a new Post entity.
     *
     * @Route("/", name="blog.admin.post.create")
     * @Method("POST")
     * @Template("ZantolovBlogBundle:Post:new.html.twig")
     */
    public function createAction(Request $request)
    {
        return parent::baseCreateAction($request, new Post(), 'blog.admin.post.show');
    }

    /**
     * Creates a form to create a Post entity.
     *
     * @param Post $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    public function createCreateForm($entity)
    {
        $postType = $this->get('zantolov_blog.post_type_factory')->make();
        return parent::createBaseCreateForm($entity, $postType, $this->generateUrl('blog.admin.post.create'));
    }

    /**
     * Displays a form to create a new Post entity.
     *
     * @Route("/new", name="blog.admin.post.new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        return parent::baseNewAction(new Post());
    }

    /**
     * Finds and displays a Post entity.
     *
     * @Route("/{id}", name="blog.admin.post.show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        return parent::baseShowAction($id);
    }

    /**
     * Displays a form to edit an existing Post entity.
     *
     * @Route("/{id}/edit", name="blog.admin.post.edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        return parent::baseEditAction($id);
    }

    /**
     * Creates a form to edit a Post entity.
     *
     * @param Post $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    public function createEditForm($entity)
    {
        $postType = $this->get('zantolov_blog.post_type_factory')->make();
        return parent::createBaseEditForm($entity, $postType, $this->generateUrl('blog.admin.post.update', array('id' => $entity->getId())));
    }

    /**
     * Edits an existing Post entity.
     *
     * @Route("/{id}", name="blog.admin.post.update")
     * @Method("PUT")
     * @Template("ZantolovBlogBundle:Post:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        return parent::baseUpdateAction($request, $id, $this->generateUrl('blog.admin.post.edit', array('id' => $id)));
    }

    /**
     * Deletes a Post entity.
     *
     * @Route("/{id}", name="blog.admin.post.delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        return parent::baseDeleteAction($request, $id, $this->generateUrl('blog.admin.post'));
    }

    /**
     * Creates a form to delete a Post entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    public function createDeleteForm($id)
    {
        return parent::baseCreateDeleteForm($this->generateUrl('blog.admin.post.delete', array('id' => $id)));
    }
}

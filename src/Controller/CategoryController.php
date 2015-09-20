<?php

namespace Zantolov\BlogBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Zantolov\AppBundle\Controller\EntityCrudController;
use Zantolov\BlogBundle\Entity\Category;
use Zantolov\BlogBundle\Form\CategoryType;

/**
 * Category controller.
 *
 * @Route("/category")
 */
class CategoryController extends EntityCrudController
{

    /**
     * @return string
     */
    protected function getEntityClass()
    {
        return 'ZantolovBlogBundle:Category';
    }


    /**
     * Lists all Category entities.
     *
     * @Route("/", name="blog.admin.category")
     * @Method("GET")
     * @Template()
     */
    public function indexAction(Request $request)
    {
        return parent::baseIndexAction($request);
    }

    /**
     * Creates a new Category entity.
     *
     * @Route("/", name="blog.admin.category.create")
     * @Method("POST")
     * @Template("ZantolovBlogBundle:Category:new.html.twig")
     */
    public function createAction(Request $request)
    {
        return parent::baseCreateAction($request, new Category(), 'blog.admin.category.show');
    }

    /**
     * Creates a form to create a Category entity.
     *
     * @param Category $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    public function createCreateForm($entity)
    {
        return parent::createBaseCreateForm($entity, new CategoryType(),
            $this->generateUrl('blog.admin.category.create')
        );
    }

    /**
     * Displays a form to create a new Category entity.
     *
     * @Route("/new", name="blog.admin.category.new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        return parent::baseNewAction(new Category());
    }


    /**
     * Finds and displays a Category entity.
     *
     * @Route("/{id}", name="blog.admin.category.show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        return $this->baseShowAction($id);
    }

    /**
     * Displays a form to edit an existing Category entity.
     *
     * @Route("/{id}/edit", name="blog.admin.category.edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        return parent::baseEditAction($id);
    }

    /**
     * Creates a form to edit a Category entity.
     *
     * @param Category $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    public function createEditForm($entity)
    {
        return parent::createBaseEditForm($entity, new CategoryType(), $this->generateUrl('blog.admin.category.update', array('id' => $entity->getId())));
    }

    /**
     * Edits an existing Category entity.
     *
     * @Route("/{id}", name="blog.admin.category.update")
     * @Method("PUT")
     * @Template("ZantolovBlogBundle:Category:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        return parent::baseUpdateAction($request, $id, $this->generateUrl('blog.admin.category.edit', array('id' => $id)));
    }

    /**
     * Deletes a Category entity.
     *
     * @Route("/{id}", name="blog.admin.category.delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        return parent::baseDeleteAction($request, $id, $this->generateUrl('blog.admin.category'));
    }

    /**
     * Creates a form to delete a Category entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    public function createDeleteForm($id)
    {
        return parent::baseCreateDeleteForm($this->generateUrl('blog.admin.category.delete', array('id' => $id)));
    }
}

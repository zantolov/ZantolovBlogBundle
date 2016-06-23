<?php

namespace Zantolov\BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Zantolov\AppBundle\Controller\Traits\CrudControllerTrait;
use Zantolov\AppBundle\Controller\Traits\EasyControllerTrait;
use Zantolov\BlogBundle\Entity\Category;
use Zantolov\BlogBundle\Form\CategoryType;

class CategoryController extends Controller
{
    use EasyControllerTrait;
    use CrudControllerTrait;

    public static function getCrudId()
    {
        return 'blog.categories';
    }

    protected function getEntityName()
    {
        return 'ZantolovBlogBundle:Category';
    }

    protected function getNewEntity()
    {
        return new Category();
    }

    protected function getCreateFormType()
    {
        return new CategoryType();
    }

}

<?php

namespace Zantolov\BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\AbstractType;
use Zantolov\AppBundle\Controller\Traits\CrudControllerTrait;
use Zantolov\AppBundle\Controller\Traits\EasyControllerTrait;
use Zantolov\BlogBundle\Entity\Post;

class PostController extends Controller
{
    use EasyControllerTrait;
    use CrudControllerTrait;

    protected $enabledFilters = array('category');

    public static function getCrudId()
    {
        return 'blog.posts';
    }

    /**
     * @return string
     */
    protected function getEntityName()
    {
        return 'ZantolovBlogBundle:Post';
    }

    protected function getNewEntity()
    {
        return new Post();
    }

    /**
     * @return AbstractType
     */
    protected function getCreateFormType()
    {
        $postType = $this->get('zantolov_blog.post_type_factory')->make();
        return $postType;
    }
}

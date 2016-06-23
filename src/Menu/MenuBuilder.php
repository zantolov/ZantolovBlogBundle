<?php

namespace Zantolov\BlogBundle\Menu;

use Doctrine\Common\Collections\ArrayCollection;
use Knp\Menu\FactoryInterface;
use Symfony\Component\HttpFoundation\RequestStack;
use Zantolov\AppBundle\Menu\MenuBuilderInterface;

class MenuBuilder implements MenuBuilderInterface
{

    private $factory;

    /**
     * @param FactoryInterface $factory
     */
    public function __construct(FactoryInterface $factory)
    {
        $this->factory = $factory;
    }

    public function createMenu(RequestStack $requestStack)
    {
        $menuItems = array();

        $menuItems['content'] = $this->factory->createItem('content', array('label' => 'Content'))
            ->setAttribute('dropdown', true)
            ->setAttribute('icon', 'fa fa-list');

        $menuItems['content']->addChild('Posts', array('route' => 'blog.posts.index'))->setAttribute('icon', 'fa fa-file');
        $menuItems['content']->addChild('Categories', array('route' => 'blog.categories.index'))->setAttribute('icon', 'fa fa-folder');

        return $menuItems;
    }


    public function getOrder()
    {
        return 5;
    }
}
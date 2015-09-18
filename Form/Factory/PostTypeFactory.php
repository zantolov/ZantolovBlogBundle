<?php

namespace Zantolov\BlogBundle\Form\Factory;

use Zantolov\BlogBundle\Repository\CategoryRepository;

class PostTypeFactory
{

    /** @var  CategoryRepository */
    private $categoryRepository;

    /**
     * @param CategoryRepository $repo
     */
    public function __construct(CategoryRepository $repo)
    {
        $this->categoryRepository = $repo;
    }

    /**
     * @param array $options
     * @return \Zantolov\BlogBundle\Form\PostType
     */
    public function make($options = array())
    {
        $categoriesQueryBuilder = $this->categoryRepository->getActiveCategoriesQueryBuilder();
        $postType = new \Zantolov\BlogBundle\Form\PostType($categoriesQueryBuilder);
        return $postType;
    }

}

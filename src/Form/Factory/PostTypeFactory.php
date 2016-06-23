<?php

namespace Zantolov\BlogBundle\Form\Factory;

use Zantolov\BlogBundle\Form\PostType;
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
        $postType = new PostType($categoriesQueryBuilder);
        return $postType;
    }

}

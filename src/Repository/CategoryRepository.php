<?php

namespace Zantolov\BlogBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Zantolov\BlogBundle\Entity\Category;

class CategoryRepository extends EntityRepository
{

    /**
     * @param $id
     * @return null|object
     */
    public function findActive($id)
    {
        return $this->findOneBy(array('active' => 1, 'id' => $id));
    }

    /**
     * @param array $options
     * @return \Doctrine\ORM\QueryBuilder
     */
    public function getActiveCategoriesQueryBuilder($options = array())
    {
        $query = $this->getEntityManager()->getRepository(Category::class)
            ->createQueryBuilder('c')
            ->where('c.active = 1');

        return $query;
    }


    /**
     * @param bool $byDate
     * @param bool $result
     * @return array|\Doctrine\ORM\Query
     */
    public function getActiveCategories($options = array())
    {
        $query = $this->getActiveCategoriesQueryBuilder($options);
        return $query->getQuery()->getResult();
    }

}
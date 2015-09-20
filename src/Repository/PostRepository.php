<?php

namespace Zantolov\BlogBundle\Repository;

use Doctrine\ORM\AbstractQuery;
use Doctrine\ORM\EntityRepository;
use Zantolov\BlogBundle\Entity\Category;
use Zantolov\BlogBundle\Entity\Post;

class PostRepository extends EntityRepository
{

    /**
     * @param array $options
     * @return \Doctrine\ORM\QueryBuilder
     */
    public function getActivePostsQueryBuilder($options = array('onlyPublished' => true))
    {
        $query = $this->getEntityManager()->getRepository(Post::class)
            ->createQueryBuilder('p')
            ->where('p.active = 1');


        if (isset($options['publishedOnly']) && $options['publishedOnly'] === true) {
            $query->andWhere('p.publishedAt <= :now')
                ->setParameter('now', new \DateTime('now'), \Doctrine\DBAL\Types\Type::DATETIME);
        }

        if (isset($options['sortByDate']) && $options['sortByDate'] === true) {
            $query->orderBy('p.publishedAt', 'DESC');
        }

        return $query;
    }

    /**
     * @param array $options
     * @return array
     */
    public function getActivePosts($options = array())
    {
        $query = $this->getActivePostsQueryBuilder($options);
        return $query->getQuery()->getResult();
    }


    /**
     * @param $categoryName
     * @param bool $result
     * @return array|\Doctrine\ORM\Query|null
     */
    public function getPostsByCategoryName($categoryName, $options = array())
    {
        $category = $this->getEntityManager()->getRepository(Category::class)->findOneBy(array('name' => $categoryName));
        if (!empty($category)) {
            return $this->getPostsByCategory($category, $options);
        } else {
            return null;
        }
    }

    /**
     * @param Category $category
     * @param array $options
     * @return \Doctrine\ORM\QueryBuilder
     */
    public function getPostsByCategoryQueryBuilder(Category $category, $options = array('sortByDate' => true, 'publishedOnly' => true))
    {
        $query = $this->getActivePostsQueryBuilder($options);

        $query->andWhere('p.category = :category')
            ->setParameter('category', $category);

        return $query;
    }

    /**
     * @param Category $category
     * @param array $options
     * @return array
     */
    public function getPostsByCategory(Category $category, $options = array('sortByDate' => true, 'publishedOnly' => true))
    {
        $query = $this->getPostsByCategoryQueryBuilder($category, $options);
        return $query->getQuery()->getResult();
    }


    /**
     * @param $slug
     * @return array
     */
    public function getPostBySlug($slug)
    {
        $query = $this->getEntityManager()->getRepository(Post::class)
            ->createQueryBuilder('p')
            ->where('p.active = 1')
            ->andWhere('p.publishedAt <= :now')
            ->setParameter('now', new \DateTime('now'))
            ->setMaxResults(1);

        return $query->getQuery()->getResult();
    }

}
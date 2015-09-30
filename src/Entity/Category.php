<?php

namespace Zantolov\BlogBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Zantolov\AppBundle\Entity\Interfaces\SluggableInterface;
use Zantolov\AppBundle\Entity\Traits\ActivableTrait;
use Gedmo\Timestampable\Traits\TimestampableEntity;
use Gedmo\SoftDeleteable\Traits\SoftDeleteableEntity;
use Zantolov\AppBundle\Entity\Traits\SluggableTrait;

/**
 * @ORM\Entity (repositoryClass="Zantolov\BlogBundle\Repository\CategoryRepository")
 * @ORM\Table(name="post_categories")
 * @ORM\HasLifecycleCallbacks
 */
class Category implements SluggableInterface
{
    use SoftDeleteableEntity;
    use ActivableTrait;
    use TimestampableEntity;
    use SluggableTrait;

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @ORM\ManyToOne(targetEntity="Category", inversedBy="children")
     * @ORM\JoinColumn(name="parent__id", referencedColumnName="id", onDelete="SET NULL")
     */
    private $parent;

    /**
     * @ORM\OneToMany(targetEntity="Category", mappedBy="parent")
     */
    private $children;

    /**
     * @var ArrayCollection $posts
     * @ORM\ManyToMany(targetEntity="Post", mappedBy="categories")
     **/
    private $posts;


    public function __construct()
    {
        $this->posts = new ArrayCollection();
    }

    public function getSluggableProperty()
    {
        return $this->getName();
    }


    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return (string)$this->name;
    }

    /**
     * @return mixed
     */
    public function getParent()
    {
        return $this->parent;
    }

    /**
     * @param mixed $parent
     */
    public function setParent($parent)
    {
        $this->parent = $parent;
    }

    /**
     * @return mixed
     */
    public function getChildren()
    {
        return $this->children;
    }

    /**
     * @param mixed $children
     */
    public function setChildren($children)
    {
        $this->children = $children;
    }

    /**
     * @return ArrayCollection
     */
    public function getPosts()
    {
        return $this->posts;
    }

    /**
     * @param mixed $post
     */
    public function addPost($post)
    {
        /** @var Post $post */
        if ($this->getPosts()->contains($post)) {
            return;
        }

        $this->getPosts()->add($post);
        $post->addCategory($this);
    }

    /**
     * @param mixed $post
     */
    public function removePost($post)
    {
        /** @var Post $post */
        if (!$this->getPosts()->contains($post)) {
            return;
        }

        $this->getPosts()->removeElement($post);
        $post->removeCategory($this);
    }

}
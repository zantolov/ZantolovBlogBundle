<?php

namespace Zantolov\BlogBundle\Entity;

use Gedmo\SoftDeleteable\Traits\SoftDeleteableEntity;
use Gedmo\Timestampable\Traits\TimestampableEntity;
use Doctrine\ORM\Mapping as ORM;
use Zantolov\AppBundle\Entity\Interfaces\SluggableInterface;
use Zantolov\AppBundle\Entity\Traits\ActivableTrait;
use Zantolov\AppBundle\Entity\Traits\SluggableTrait;
use Zantolov\MediaBundle\Entity\Traits\ImageableTrait;

/**
 * @ORM\Entity (repositoryClass="Zantolov\BlogBundle\Repository\PostRepository")
 * @ORM\Table(name="posts")
 * @ORM\HasLifecycleCallbacks
 */
class Post implements SluggableInterface
{
    use SoftDeleteableEntity;
    use TimestampableEntity;
    use ActivableTrait;
    use SluggableTrait;
    use ImageableTrait;

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;


    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255)
     */
    private $title;


    /**
     * @var string
     *
     * @ORM\Column(type="text")
     */
    private $intro = null;


    /**
     * @var string
     *
     * @ORM\Column(type="text", nullable=true)
     */
    private $body;


    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $keywords;


    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $author = null;


    /**
     * @var \DateTime
     *
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $publishedAt;


    /**
     * @var Category $category
     * @ORM\ManyToOne(targetEntity="Category")
     * @ORM\JoinColumn(name="category_id", referencedColumnName="id")
     **/
    protected $category;


    public function getSluggableProperty()
    {
        return $this->getTitle();
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param mixed $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @return null
     */
    public function getIntro()
    {
        return $this->intro;
    }

    /**
     * @param null $intro
     */
    public function setIntro($intro)
    {
        $this->intro = $intro;
    }

    /**
     * @return mixed
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * @param mixed $body
     */
    public function setBody($body)
    {
        $this->body = $body;
    }

    /**
     * @return mixed
     */
    public function getKeywords()
    {
        return $this->keywords;
    }

    /**
     * @param mixed $keywords
     */
    public function setKeywords($keywords)
    {
        $this->keywords = $keywords;
    }

    /**
     * @return null
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * @param null $author
     */
    public function setAuthor($author)
    {
        $this->author = $author;
    }

    /**
     * @return mixed
     */
    public function getPublishedAt()
    {
        return $this->publishedAt;
    }

    /**
     * @param mixed $publishedAt
     */
    public function setPublishedAt($publishedAt)
    {
        $this->publishedAt = $publishedAt;
    }

    /**
     * @return Category
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * @param Category $category
     */
    public function setCategory($category)
    {
        $this->category = $category;
    }

}
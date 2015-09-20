<?php

namespace Zantolov\BlogBundle\Form;

use Doctrine\ORM\QueryBuilder;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Zantolov\BlogBundle\Entity\Category;
use Zantolov\MediaBundle\Form\EventSubscriber\ImagesChooserFieldAdderSubscriber;

class PostType extends AbstractType
{
    private $categoriesQueryBuilder;

    public function __construct(QueryBuilder $categoriesQueryBuilder)
    {
        $this->categoriesQueryBuilder = $categoriesQueryBuilder;
    }

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $imagesSubscriber = new ImagesChooserFieldAdderSubscriber('image', array('multiple' => false));
        $builder->addEventSubscriber($imagesSubscriber);

        $builder
            ->add('title')
            ->add('slug', null, array('required' => false))
            ->add('intro', 'ckeditor', array('required' => false))
            ->add('body', 'ckeditor')
            ->add('category', 'entity', array(
                'class'         => Category::class,
                'query_builder' => $this->categoriesQueryBuilder,
                'property'      => 'name'
            ))
            ->add('author', null, array('required' => false))
            ->add('keywords', null, array('required' => false))
            ->add('publishedAt', null, array('required' => false))
            ->add('active', null, array('required' => false));


    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Zantolov\BlogBundle\Entity\Post'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'zantolov_blogbundle_post';
    }
}

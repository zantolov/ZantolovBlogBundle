<?php

namespace Zantolov\BlogBundle\Form;

use Doctrine\ORM\QueryBuilder;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\CallbackTransformer;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Routing\RouterInterface;
use Zantolov\AppBundle\Form\Type\DatetimePickerType;
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

        $imagesSubscriber = new ImagesChooserFieldAdderSubscriber('image', array('label' => 'Image', 'multiple' => false));
        $builder->addEventSubscriber($imagesSubscriber);

        $builder
            ->add('title')
            ->add('slug', null, array('required' => false))
            ->add('intro', 'textarea', array('required' => false))
            ->add('body', 'ckeditor', array(
                'config' => array(
                    'filebrowserBrowseRoute'      => 'zantolov.media.document.popup.browse.ckeditor',
                    'filebrowserImageBrowseRoute' => 'zantolov.media.image.popup.browse.ckeditor',
                )
            ))
            ->add('categories', 'entity', array(
                'required'      => false,
                'multiple'      => true,
                'class'         => 'ZantolovBlogBundle:Category',
                'query_builder' => $this->categoriesQueryBuilder,
            ))
            ->add('author', null, array('required' => false))
            ->add('keywords', null, array('required' => false))
            ->add('publishedAt', new DatetimePickerType())
            ->add('active', null, array('required' => false))
            ->add('isPage', null, array('required' => false));

        $builder->get('publishedAt')->addModelTransformer(new CallbackTransformer(
            function (\Datetime $dateTime) {
                return $dateTime->format('d.m.Y. H:i');
            },
            function ($datetimeText) {
                return \DateTime::createFromFormat('d.m.Y. H:i', $datetimeText);
            }
        ));

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

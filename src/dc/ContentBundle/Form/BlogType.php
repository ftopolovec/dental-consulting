<?php

namespace dc\ContentBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class BlogType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title')
            ->add('date','date')
            ->add('file')
            ->add('abstract','textarea')
            ->add('content', 'ckeditor', array(
                'config' => array(
                    'filebrowser_image_browse_url' => array(
                        'route' => 'elfinder',
                        'route_parameters' => array('instance' => 'default'),
                    ),
                    'uiColor' => '#ffffff',
                    //...
                ),
            ))
            ->add('category')
        ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'dc\ContentBundle\Entity\Blog'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'dc_contentbundle_blog';
    }
}

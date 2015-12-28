<?php

namespace dc\ContentBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CourseType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title')
            ->add('datestart', 'date')
            ->add('dateend', 'date')
            ->add('price')
            ->add('lecturer')
            ->add('abstract','textarea')
            ->add('file')
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
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'dc\ContentBundle\Entity\Course'
        ));
    }
}

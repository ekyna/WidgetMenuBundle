<?php

namespace Victoire\Widget\MenuBundle\Form;

use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Victoire\Bundle\CoreBundle\Form\WidgetType;

/**
 * WidgetMenu form type
 */
class WidgetMenuType extends WidgetType
{
    /**
     * define form fields
     * @param FormBuilderInterface $builder
     * @param array                $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add(
                'name',
                null,
                array(
                    'label'     => 'menu.form.name.label',
                    'required'  => true,
                    'vic_help_label_tooltip' => array('menu.form.name.help_label_tooltip'),
                )
            )
            ->add(
                'items',
                'collection',
                array(
                    'property_path' => 'children',
                    'type'          => 'victoire_form_menu',
                    'options'       => array(
                        'namespace'  => null,
                        'entityName' => null,
                        'mode'       => "static",
                    ),
                    'required'      => false,
                    'allow_add'     => true,
                    'allow_delete'  => true,
                    'by_reference'  => false,
                    'prototype'     => true,
                )
            );

        parent::buildForm($builder, $options);
    }

    /**
     * bind form to WidgetRedactor entity
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        parent::setDefaultOptions($resolver);

        $resolver->setDefaults(
            array(
                'data_class'         => 'Victoire\Widget\MenuBundle\Entity\WidgetMenu',
                'widget'             => 'menu',
                'translation_domain' => 'victoire',
            )
        );
    }

    /**
     * get form name
     *
     * @return string The name of the form
     */
    public function getName()
    {
        return 'victoire_widget_form_menu';
    }
}

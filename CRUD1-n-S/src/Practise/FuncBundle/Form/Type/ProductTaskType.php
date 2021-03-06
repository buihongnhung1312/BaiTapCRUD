<?php

namespace Practise\FuncBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;
use Symfony\Component\Form\FormBuilderInterface;

class ProductTaskType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', 'text')
            ->add('sku', 'number', array('pattern' => '0[0-9]{8}'))
            ->add('description', 'text')
            ->add('price', 'number', array('pattern' => '[0-9]{1,9}'))
            ->add('category', 'entity', array(
                'class' => 'FuncBundle:Category',
                'property' => 'name',
                'multiple' => false,
                'expanded' => false,
                'empty_data' => null,
                'required' => false,
                ))
            ->add('save', 'submit');
    }

    // public function setDefaultOptions(OptionsResolverInterface $resolver)
    // {
    //     $resolver->setDefaults(array(
    //         'data_class' => 'Exercise01\DaTaBundle\Entity\Product',
    //     ));
    // }

    public function getName()
    {
        return 'product';
    }
}
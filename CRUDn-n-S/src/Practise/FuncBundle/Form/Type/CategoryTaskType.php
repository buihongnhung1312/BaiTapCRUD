<?php

namespace Practise\FuncBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class CategoryTaskType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('name', 'text')
        ->add('description', 'text')
        ->add('position', 'number', array('pattern' => '[0-9]+'))
        ->add('save', 'submit');
        if ($options['id']) {
            $builder->add('categories', 'entity', array(
            'class' => 'FuncBundle:Category',
            'property' => 'name',
            'multiple' => true,
            'expanded' => true,
            'empty_data' => null,
            'required' => false,
            'query_builder' => function(\Doctrine\ORM\EntityRepository $er) use($options) {
                        return $er->createQueryBuilder('result')
                        ->where('result.id != '.$options['id']);
                    }           
            ));
        }
        else {
            $builder->add('categories', 'entity', array(
                'class' => 'FuncBundle:Category',
                'property' => 'name',
                'multiple' => true,
                'expanded' => true,
                'empty_data' => null,
                'required' => false,           
            ));
        }
        
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Practise\FuncBundle\Entity\Category',
            'id' => null
        ));
    }

    public function getName()
    {
        return 'product';
    }
}
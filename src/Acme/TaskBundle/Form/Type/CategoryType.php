<?php
/**
 * Created by PhpStorm.
 * User: develop1
 * Date: 01.06.15
 * Time: 13:57
 */

namespace Acme\TaskBundle\Form\Type;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CategoryType extends AbstractType
{
    public function builderForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('name');
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Acme\TaskBundle\Entity\Category'
        ));
    }

    public function getName()
    {
        return 'category';
    }

}
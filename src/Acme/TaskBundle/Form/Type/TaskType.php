<?php
/**
 * Created by PhpStorm.
 * User: develop1
 * Date: 01.06.15
 * Time: 11:30
 */

namespace Acme\TaskBundle\Form\Type;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TaskType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('task', null, array('label' => 'Task name: '))
            ->add('dueDate', 'date', array('widget' => 'single_text','label'=> 'Due Date: '))
            ->add('dueTime', 'time', array('widget' => 'single_text', 'label' => 'Due Time: '))
            ->add('createdDate', 'datetime', array('read_only' => true, 'disabled' => true, 'widget' => 'single_text', 'label' => 'Created time: '))
//            ->add('role', 'text', array('read_only' => true, 'disabled' => true, 'label' => 'User role: '))
            ->add('category', 'entity', array('class' =>'Acme\TaskBundle\Entity\Category', 'label' => 'Category: '))
            ->add('Save task', 'submit');
    }

    public function getName()
    {
        return 'task';
    }
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Acme\TaskBundle\Entity\Task',
        ));
    }
}

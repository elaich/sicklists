<?php

namespace Sick\Bundle\ListsBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ListItemType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
			->add('text', 'text', array(
				'label' => 'Task',
				'attr' => array('placeholder' => 'Enter a task')
			))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Sick\Bundle\ListsBundle\Entity\ListItem'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'sick_lists_form';
    }
}

<?php

namespace AttedanceManagement\UserBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class StudentFormType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array                $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstName')
            ->add('lastName')
            ->add('telephone')
            ->add('address')
            ->add('address', TextareaType::class)
            ->add('classGroup', EntityType::class,
                [
                    'class' => 'AttedanceManagement\UserBundle\Entity\ClassGroup',
                    'choice_label' => 'name',
                ]
            );
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AttedanceManagement\UserBundle\Entity\Student',
        ));
    }
}

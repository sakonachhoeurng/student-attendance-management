<?php

namespace AttedanceManagement\UserBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use AttedanceManagement\UserBundle\Repository\UserRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\DateType;

class SubjectGroupFormType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array                $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('startDate', DateType::class)
            ->add('endDate', DateType::class)
            ->add('classGroup', EntityType::class,
                [
                    'class' => 'AttedanceManagement\UserBundle\Entity\ClassGroup',
                    'choice_label' => 'name',
                ]
            )
            ->add('subject', EntityType::class,
                [
                    'class' => 'AttedanceManagement\UserBundle\Entity\Subject',
                    'choice_label' => 'name',
                ]
            )
            ->add('user', EntityType::class,
                [
                    'class' => 'AttedanceManagement\UserBundle\Entity\User',
                    'query_builder' => function(UserRepository $repo) {
                        return $repo->findAllTeacher();
                    },
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
            'data_class' => 'AttedanceManagement\UserBundle\Entity\SubjectGroup',
        ));
    }
}

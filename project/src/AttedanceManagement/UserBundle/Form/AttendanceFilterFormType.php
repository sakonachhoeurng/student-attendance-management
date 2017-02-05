<?php

namespace AttedanceManagement\UserBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use AttedanceManagement\UserBundle\Repository\SubjectRepository;
use AttedanceManagement\UserBundle\Repository\ClassGroupRepository;

class AttendanceFilterFormType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->setMethod('GET')
            ->add('classGroup', EntityType::class,
                [
                    'class' => 'AttedanceManagement\UserBundle\Entity\ClassGroup',
                    'query_builder' => function(ClassGroupRepository $repo) use ($options) {
                        return $repo->findByTeacher($options['user']);
                    },
                    'choice_label' => 'name'
                ]
            )
            ->add('subject', EntityType::class,
                [
                    'class' => 'AttedanceManagement\UserBundle\Entity\Subject',
                    'query_builder' => function(SubjectRepository $repo) use ($options) {
                        return $repo->findByTeacher($options['user']);
                    },
                    'choice_label' => 'name'
                ]
            )
        ;
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        parent::configureOptions($resolver);

        $resolver->setDefaults([
            'user' => null,
        ]);
    }

    public function getName()
    {
        return 'attendance';
    }
}

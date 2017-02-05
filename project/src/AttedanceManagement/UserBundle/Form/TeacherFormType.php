<?php

namespace AttedanceManagement\UserBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class TeacherFormType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array                $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('username')
            ->add('name')
            ->add('email')
            ->add('phoneNumber')
            ->add(
                    'plainPassword',
                    'Symfony\Component\Form\Extension\Core\Type\RepeatedType',
                    [
                        'type' => 'Symfony\Component\Form\Extension\Core\Type\PasswordType',
                        'options' => ['translation_domain' => 'FOSUserBundle'],
                        'invalid_message' => 'fos_user.password.mismatch',
                    ]
            )
            ->add('address', TextareaType::class,[
            	'required' => false
            ]);
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AttedanceManagement\UserBundle\Entity\User',
        ));
    }
}

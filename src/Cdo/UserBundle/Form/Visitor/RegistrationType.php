<?php

namespace Cdo\UserBundle\Form\Visitor;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class RegistrationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('username', 'text', array(
                'label' => 'Nom d\'utilisateur',
            ))
            ->add('email', 'email', array(
                'label' => 'Email',
            ))
            ->add('plainPassword', 'password', array(
                'label' => 'Mot de passe',
            ))
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Cdo\UserBundle\Entity\User',
        ));
    }

    public function getName()
    {
        return 'cdo_userbundle_visitor_registrationtype';
    }
}

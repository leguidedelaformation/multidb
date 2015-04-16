<?php

namespace Apm\AccountBundle\Form\Master\Account;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class CreateType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('subdomain', 'text', array(
                'label' => 'Sous-domaine',
            ))
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Cdo\AccountBundle\Entity\Account',
        ));
    }

    public function getName()
    {
        return 'pdm_accountbundle_master_account_createtype';
    }
}

<?php

namespace App\Form;

use App\Entity\SemRegistre;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SemRegistreType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('civilite')
            ->add('nom')
            ->add('prenom')
            ->add('intitule_poste')
            ->add('phone')
            ->add('phone_fix')
            ->add('raison_soc')
            ->add('adresse')
            ->add('code_postale')
            ->add('ville')
            ->add('pays')
            ->add('web_site')
            ->add('activity')
            ->add('etat_dem')
            ->add('user')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => SemRegistre::class,
        ]);
    }
}

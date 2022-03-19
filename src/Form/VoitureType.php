<?php

namespace App\Form;

use App\Entity\Voiture;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class VoitureType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('titre')
            ->add('model',ChoiceType::class,[
                'choices'  => [
                    'Accord' => 'Accord',
                    "BENTLEY" => "BENTLEY",
                    "BMW X" => "BMW X",
                    "BOLLORE BLUECAR" =>"BOLLORE BLUECAR"
                ],
                    ])
            ->add('annee',DateType::class, [
                // renders it as a single text box
                'placeholder' => [
                    'year' => 'Year', 'month' => 'Month', 'day' => 'Day',
                ],
            ])
            ->add('price')
            ->add('ville',ChoiceType::class,[
                'choices'  => [
                    'Bizrete' => 'Bizrete',
                    "Tunis" => "Tunis",
                    "Sousse" => "Sousse",
                    "Mahdia" => "Mahdia",
                    "Tataouine" => "Tataouine",
                    "Touzeur" => "Touzeur",
                    "Béja" => "Béja",
                    "Nabeul"=>"Nabeul",
                   
                ],
            ])
            ->add('location')
            ->add('description')
            ->add('imges',FileType::class,[
                'label'=>'Ajouter votre dossier ..',
                'mapped'=> false,
                'required'=>false,
                'multiple'=>true
                  ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Voiture::class,
        ]);
    }
}

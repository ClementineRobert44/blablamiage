<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;

class VoitureType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('marqueVoiture', TextType::class, [
            'label' => 'Marque'                
        ])
        ->add('modeleVoiture', TextType::class, [
            'label' => 'Modèle'
            ])    
        
        ->add('couleurVoiture', TextType::class, [
            'label' => 'Couleur'
            ])

        ->add('anneeVoiture', DateType::class, [
            'label' => 'Année de la voiture'
            ])

        ->add('nbPlacesVoiture',ChoiceType::class, [
            'choices' => [
            'Selectionné' => '', '1' => 1,'2' => 2, '3' => 3,'4' => 4,'5' => 5,'6' => 6],
            'label' => 'Nombre de places dans la voiture (sans compter le conducteur)', 
            'constraints' => [new NotBlank()]] 
            )
        ->add('tailleBagages',ChoiceType::class, [
            'choices' => [
            'Selectionné' => '', 'Petit' => 'Petit','Moyen' => 'Moyen', 'Grand' => 'Grand',],
            'label' => 'Taille de bagages autorisée', 
            'constraints' => [new NotBlank()]] 
            )

        ->add('idUtilisateur',EntityType::class, [
            'label' => 'idUtilisateur'
        ])

        ->add('idUtilisateur', EntityType::class, [
            'class' => User::class,
            'multiple' => false,
            'expanded' => true,
            'choice_label' => 'nom'
        ])

        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}

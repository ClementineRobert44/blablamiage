<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TimeType as TypeTimeType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;

class TrajetType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('dateDepart', DateType::class, [
            'label' => 'Date départ'
            ])
        ->add('heureDepart', TypeTimeType::class, [
            'label' => 'Heure de départ'                
        ])
        
        ->add('adresseDepart', TextType::class, [
            'label' => 'Adresse Départ'                
        ])

        ->add('codePostalDepart', NumberType::class, [
            'label' => 'Code Postal de Départ'                
        ])

        ->add('villeDepart', TextType::class, [
            'label' => 'Ville de départ'                
        ])

        ->add('adresseArrivee', TextType::class, [
            'label' => "Adresse d'arrivée"                
        ])

        ->add('codePostalArrivee', NumberType::class, [
            'label' => "Code Postal d'arrivée"                
        ])

        ->add('villeArrivee', TextType::class, [
            'label' => "Ville d'arrivée"                
        ])

        ->add('prixTrajet', NumberType::class, [
            'label' => "Prix du trajet"                
        ])

        /*->add('idUtilisateur', EntityType::class, [
            'class' => User::class,
            'multiple' => false,
            'expanded' => true,
            'choice_label' => 'nom'
        ])*/

        ->add('nbPassagers',ChoiceType::class, [
            'choices' => [
            'Selectionné' => '', '1' => 1,'2' => 2, '3' => 3,'4' => 4,'5' => 5,'6' => 6],
            'label' => 'Nombre de places dans la voiture (sans compter le conducteur)', 
            'constraints' => [new NotBlank()]] 
            )

        
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}

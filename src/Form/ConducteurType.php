<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class ConducteurType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nomConducteur', TextType::class, [
                'label' => 'Nom'                
            ])
            ->add('prenomConducteur', TextType::class, [
                'label' => 'Prenom'
                ])
            ->add('dateNaissanceConducteur', BirthdayType::class, [
                'format' => 'dd/MM/yyyy',
                'label' => 'Date de naissance'
            ])
            ->add('mailConducteur', EmailType::class, [
                'label' => 'Adresse mail'
                ])
            ->add('bioConducteur', TextareaType::class, [
                'label' => 'Biographie'
                ])
            ->add('telConducteur', NumberType::class, [
                'label' => 'Numéro de téléphone',
                'constraints' => [
                    new Length(['max' => 9, 'min' => 9]),
 ] 
                ])
            ->add('animaux',ChoiceType::class, [
                'choices' => [
                'Selectionné' => '','Refusé' => 'non','Accepté' => 'oui'],
                'label' => 'Animaux'])
            ->add('cigarette',ChoiceType::class, [
                'choices' => [
                'Selectionné' => '', 'Refusé' => 'non','Accepté' => 'oui', ],
                'label' => 'Cigarette', 
                'constraints' => [new NotBlank()]] 
                )
            ->add('mdpConducteur', PasswordType::class, [
                'label' => 'Mot de passe'
                ]
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

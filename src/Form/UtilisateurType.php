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

class UtilisateurType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom', TextType::class, [
                'label' => 'Nom'                
            ])
            ->add('prenom', TextType::class, [
                'label' => 'Prenom'
                ])
            ->add('dateNaissance', BirthdayType::class, [
                'format' => 'dd/MM/yyyy',
                'label' => 'Date de naissance'
            ])
            ->add('mail', EmailType::class, [
                'label' => 'Adresse mail'
                ])
            ->add('bio', TextareaType::class, [
                'label' => 'Biographie'
                ])
            ->add('tel', NumberType::class, [
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
            
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}

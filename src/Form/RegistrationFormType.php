<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Validator\Constraints\NotBlank;

class RegistrationFormType extends AbstractType
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
                'label' => 'Date de naissance',
                'widget' => 'single_text',
                'attr' => ['class' => 'js-datepicker']
            ])
            ->add('email', EmailType::class, [
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
                    'Oui' => true,'Non' => false, ],
                    'label' => 'Animaux autorisés ?']
                    )

            ->add('cigarette',ChoiceType::class, [
                'choices' => [
                    'Oui' => true,'Non' => false, ],
                    'label' => 'Cigarette autorisée ?']
                    )

            ->add('sexe',ChoiceType::class, [
                'choices' => [
                    'Homme' => 'Homme','Femme' => 'Femme', ],
                    'label' => 'Sexe']
                    )

            ->add('plainPassword', PasswordType::class, [
                // instead of being set onto the object directly,
                // this is read and encoded in the controller
                'mapped' => false,
                'constraints' => [
                    new NotBlank([
                        'message' => 'Please enter a password',
                    ]),
                    new Length([
                        'min' => 6,
                        'minMessage' => 'Your password should be at least {{ limit }} characters',
                        // max length allowed by Symfony for security reasons
                        'max' => 4096,
                    ]),
                ],
            ])        
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}

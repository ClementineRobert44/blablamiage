<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email')
            ->add('agreeTerms', CheckboxType::class, [
                'mapped' => false,
                'constraints' => [
                    new IsTrue([
                        'message' => 'You should agree to our terms.',
                    ]),
                ],
            ])

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
                'Selectionné' => '','Refusé' => 'non','Accepté' => 'oui'],
                'label' => 'Animaux'])
            ->add('cigarette',ChoiceType::class, [
                'choices' => [
                'Selectionné' => '', 'Refusé' => 'non','Accepté' => 'oui', ],
                'label' => 'Cigarette', 
                'constraints' => [new NotBlank()]] 
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

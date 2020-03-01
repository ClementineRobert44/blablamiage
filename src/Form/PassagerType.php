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

;

class PassagerType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nomPassager', TextType::class)
            ->add('prenomPassager', TextType::class)
            ->add('dateNaissancePassager', BirthdayType::class, [
                'format' => 'dd/MM/yyyy',
            ])
            ->add('mailPassager', EmailType::class)
            ->add('bioPassager', TextareaType::class)
            ->add('telPassager', NumberType::class)
            ->add('animaux',ChoiceType::class, [
                'choices' => [
                'Selectionné' => '','Refusé' => 'non','Accepté' => 'oui'],
                'label' => 'Animaux'])
            ->add('cigarette',ChoiceType::class, [
                'choices' => [
                'Selectionné' => '', 'Refusé' => 'non','Accepté' => 'oui', ],
                'label' => 'Cigarette'])
            ->add('mdpPassager', PasswordType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}

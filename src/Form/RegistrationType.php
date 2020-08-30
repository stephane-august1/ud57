<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;

class RegistrationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email', EmailType::class, [
                'required' => true,
                'label' => 'Votre Email',
            ])
            ->add('name', TextType::class, [
                'required' => true,
                'label' => 'Nom d\'utilisateur ',
            ])
            ->add('password', PasswordType::class, [
                'required' => true,
                'label' => 'Votre mot de passe'
            ])
            ->add('confirm_password', PasswordType::class, [
                'required' => true,
                'label' => 'Confirmation du mot de passe',
            ])

            ->add('adresse', TextType::class, [
                'required' => false,
                'label' => 'Votre adresse',
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}

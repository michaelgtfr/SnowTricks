<?php
/**
 * User: michaelgtfr
 */

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class RegisterForm extends AbstractType
{
    /**
     * Creation of the registration form
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email', EmailType::class)
            ->add('name', TextType::class, [
                'label' => 'Nom'
            ])
            ->add('password', PasswordType::class, [
                'label' => 'Mot de passe'
            ])
            ->add('passwordCheck', PasswordType::class, [
                'mapped' => false,
                'label' => 'Confirmation du mot de passe'
                ])
            ->add('picture', FileType::class,[
                'label' => 'Avatar',
                'attr' => [
                    'lang' => 'fr',
                ]
            ])
            ->add('presentation', TextareaType::class)
            -> add ( 'validate' , SubmitType::class, [
                'label' => 'Valider'
            ] )
        ;
    }
}

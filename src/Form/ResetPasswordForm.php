<?php
/**
 * Created by PhpStorm.
 * User: mickd
 * Date: 07/12/2019
 * Time: 09:36
 */

namespace App\Form;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;

class ResetPasswordForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email', EmailType::class, [
                'mapped' => false
            ])
            ->add('passwordOne', PasswordType::class, [
                'label' => 'Mot de passe',
                'mapped' => false
            ])
            ->add('passwordTwo', PasswordType::class, [
                'label' => 'Ré-écrivez votre mot de passe',
                'mapped' => false
            ])
            ->add( 'validate' , SubmitType::class, [
                'label' => 'Valider'
            ])
        ;
    }
}
<?php
/**
 * Created by PhpStorm.
 * User: mickd
 * Date: 06/12/2019
 * Time: 19:54
 */

namespace App\Form;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;

class ForgotPasswordForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email', EmailType::class, [
                'label' => 'email'
            ])
            -> add ( 'validate' , SubmitType::class, [
                'label' => 'Valider'
            ])
        ;
    }
}

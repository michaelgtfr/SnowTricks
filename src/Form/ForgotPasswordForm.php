<?php
/**
 * User: michaelgtfr
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
    /**
     * Form for retrieving email
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email', EmailType::class, [
                'label' => 'Email'
            ])
            -> add ( 'validate' , SubmitType::class, [
                'label' => 'Valider'
            ])
        ;
    }
}

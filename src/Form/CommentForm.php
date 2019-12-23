<?php
/**
 * User: michaelgtfr
 */

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class CommentForm extends AbstractType
{
    /**
     * Creation of the comment form
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('comment', TextType::class, [
                'label' => 'Commentaire'
            ])
            -> add ( 'validate' , SubmitType::class, [
                'label' => 'Valider'
            ] )
            ;
    }
}

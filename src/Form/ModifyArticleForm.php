<?php
/**
 * Created by PhpStorm.
 * User: mickd
 * Date: 19/11/2019
 * Time: 16:02
 */

namespace App\Form;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class ModifyArticleForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class, [
                'label' => 'titre'
            ])
            ->add('chapo', TextType::class)
            ->add('content', TextareaType::class, [
                'label' => 'Contenu'
            ])
            ->add('validate', SubmitType::class, [
                'label' => 'Valider'
            ]);
    }
}
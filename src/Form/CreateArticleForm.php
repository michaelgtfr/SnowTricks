<?php
/**
 * User: michaelgtfr
 * Date: 06/11/2019
 * Time: 19:07
 */

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\FormBuilderInterface;

class CreateArticleForm extends AbstractType
{
    /**
     * article creation form
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class, [
                'label' => 'Titre'
            ])
            ->add('files', CollectionType::class, [
                'entry_type' => FileType::class,
                    'entry_options' => [
                        'attr' => [
                            'lang' => 'fr',
                        ]
                ],
                'mapped' => false,
                'allow_add' => true,
                'allow_delete' => true,
                'prototype' => true,
                'label' => false,
            ])
            ->add('movies', CollectionType::class, [
                'entry_type' => UrlType::class,
                'entry_options' => [
                    'attr' => [ 'class' => 'movies-box' ],
                ],
                'mapped' => false,
                'allow_add' => true,
                'allow_delete' => true,
                'prototype' => true,
                'label' => false,
            ])
            ->add('chapo', TextType::class)
            ->add('content', TextareaType::class, [
                'label' => 'Contenu'
            ])
            -> add ( 'validate' , SubmitType::class, [
            'label' => 'Valider'
            ])
        ;
    }
}

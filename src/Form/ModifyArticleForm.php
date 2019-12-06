<?php
/**
 * Created by PhpStorm.
 * User: mickd
 * Date: 19/11/2019
 * Time: 16:02
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

class ModifyArticleForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class, [
                'label' => 'titre'
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
                'label' => 'Photo( taille max: 2mo, type: jpg, jpeg, png)'
            ])
            ->add('movies', CollectionType::class, [
                'entry_type' => UrlType::class,
                'entry_options' => [
                    'attr' => [ 'class' => 'movies-box' ],
                ],
                'label' => 'Lien vidéo',
                'mapped' => false,
                'allow_add' => true,
                'allow_delete' => true,
                'prototype' => true
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
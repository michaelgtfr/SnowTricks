<?php
/**
 * User: michaelgtfr
 * Date: 19/11/2019
 * Time: 16:02
 */

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\File;

class ModifyArticleForm extends AbstractType
{
    /**
     * article modification form
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class, [
                'label' => 'Titre',
                'attr' => [
                    'maxLength' => 8,
                ],
            ])
            ->add('uploadFile', CollectionType::class, [
                'entry_type' => FileType::class,
                'entry_options' => [
                    'constraints' => [
                        new File([
                            'maxSize' => '2048k',
                            'mimeTypes' => [
                                'image/jpg',
                                'image/jpeg',
                                'image/png'
                            ],
                            'mimeTypesMessage' => 'attention!! les images autorisés sont le png, jpg ou jpeg',
                        ])
                    ],
                    'attr' => [
                        'lang' => 'fr',
                    ]
                ],
                'allow_add' => true,
                'allow_delete' => true,
                'prototype' => true,
                'label' => false
            ])
            ->add('linkUploaded', CollectionType::class, [
                'entry_type' => UrlType::class,
                'entry_options' => [
                    'attr' => [ 'class' => 'movies-box' ],
                ],
                'label' => false,
                'allow_add' => true,
                'allow_delete' => true,
                'prototype' => true
            ])
            ->add('chapo', TextType::class, [
                'attr' => [
                    'maxLength' => 255,
                ],
            ])
            ->add('content', TextareaType::class, [
                'label' => 'Contenu',
                'attr' => [
                    'rows' => 5,
                ]
            ])
            ;
    }
}

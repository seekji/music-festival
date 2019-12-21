<?php

namespace App\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Form\Type\ModelListType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Validator\Constraints\Count;

/**
 * Class HistoryAdmin
 * @package App\Admin
 */
class HistoryAdmin extends AbstractAdmin
{

    /**
     * @param FormMapper $form
     */
    protected function configureFormFields(FormMapper $form)
    {
        $form
            ->add('year')
            ->add('viewers', IntegerType::class)
            ->add('viewersTitle', TextType::class)
            ->add('picture', ModelListType::class, ['required' => true], ['link_parameters' => ['context' => 'static_pages']])
            ->add('description', TextareaType::class)
            ->add('lineup', CollectionType::class, [
                'by_reference' => false,
                'allow_add' => true,
                'allow_delete' => true,
                'prototype' => true,
                'entry_type' => TextType::class,
                'constraints' => [
                    new Count(['min' => 1])
                ]
            ]);
    }
}
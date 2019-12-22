<?php

namespace App\Admin;

use App\Form\Type\RouteForm;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Form\Type\AdminType;
use Sonata\AdminBundle\Route\RouteCollection;

class ZoneAdmin extends AbstractAdmin
{

    protected function configureRoutes(RouteCollection $collection)
    {
        $collection
            ->add('clone', $this->getRouterIdParameter() . '/clone');
    }

    /**
     * @param ListMapper $list
     */
    protected function configureListFields(ListMapper $list)
    {
        unset($this->listModes['mosaic']);

        $list
            ->add('id')
            ->add('city')
            ->add('_action', null, [
                'actions' => [
                    'edit' => [],
                    'clone' => [
                        'template' => 'admin/CRUD/list__action_clone.html.twig',
                    ],
                    'delete' => [],
                ],
            ]);
    }

    /**
     * @param FormMapper $form
     */
    protected function configureFormFields(FormMapper $form)
    {
        $form
            ->add('city')
            ->add('description', CKEditorType::class, ['config' => ['toolbar' => 'basic']])
            ->add('howToRoute', \Symfony\Component\Form\Extension\Core\Type\CollectionType::class, [
                'by_reference' => false,
                'allow_add' => true,
                'allow_delete' => true,
                'prototype' => true,
                'entry_type' => RouteForm::class,
            ])
            ->add('lineup', \Sonata\Form\Type\CollectionType::class, [
                'type' => AdminType::class,
                'by_reference' => false,
            ], [
                'edit' => 'inline',
                'inline' => 'table',
                'sortable' => 'position',
            ]);
    }
}
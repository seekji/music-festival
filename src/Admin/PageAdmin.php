<?php

namespace App\Admin;

use App\Entity\Locale\LocaleInterface;
use App\Entity\Page;
use App\Form\Type\FaqForm;
use App\Form\Type\LinksForm;
use App\Form\Type\RouteForm;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Form\Type\AdminType;
use Sonata\AdminBundle\Form\Type\ChoiceFieldMaskType;
use Sonata\AdminBundle\Form\Type\ModelListType;
use Sonata\AdminBundle\Form\Type\ModelType;
use Sonata\AdminBundle\Route\RouteCollection;
use Sonata\AdminBundle\Show\ShowMapper;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Sonata\Form\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Validator\Constraints\Regex;

/**
 * Class PageAdmin
 * @package App\Admin
 */
class PageAdmin extends AbstractAdmin implements PreviewableAdminInterface
{

    /**
     * @param DatagridMapper $filter
     */
    protected function configureDatagridFilters(DatagridMapper $filter)
    {
        $filter
            ->add('id')
            ->add('title')
            ->add('locale', null, [], ChoiceType::class, [
                'choices' => array_flip(LocaleInterface::LOCALE_LIST)
            ]);
    }

    /**
     * @param ListMapper $list
     */
    protected function configureListFields(ListMapper $list)
    {
        unset($this->listModes['mosaic']);

        $list
            ->add('id')
            ->add('title')
            ->add('slug', null, [
                'template' => 'admin/CRUD/list_url_field.html.twig',
            ])
            ->add('locale', 'choice', ['choices' => LocaleInterface::LOCALE_LIST])
            ->add('template', 'choice', ['choices' => Page::TEMPLATES])
            ->add('createdAt')
            ->add('updatedAt')
            ->add('isActive')
            ->add('_action', null, [
                'actions' => [
                    'show' => [],
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
            ->with('Свойства страницы', ['class' => 'col-md-9'])
                ->add('locale', ChoiceType::class, [
                    'choices' => array_flip(LocaleInterface::LOCALE_LIST)
                ])
                ->add('title')
                ->add('slug')
                ->add('subTitle')
                ->add('picture', ModelListType::class, ['required' => true], ['link_parameters' => ['context' => 'static_pages']])
                ->add('description', CKEditorType::class, ['required' => false])
                ->add('coordinates', TextType::class, [
                    'required' => false,
                    'help' => 'Формат: `широта;долгота`, например: <strong>39.1;39.2</strong>',
                    'constraints' => [
                        new Regex("/^([-]?)([\d]+)((((\.)(\d+))?(;)))(([-]?)([\d]+)((\.)(\d+))?)$/")
                    ]
                ])
                ->add('mapLink', TextType::class, ['required' => false])
                ->add('howToRoute', \Symfony\Component\Form\Extension\Core\Type\CollectionType::class, [
                    'by_reference' => false,
                    'allow_add' => true,
                    'allow_delete' => true,
                    'prototype' => true,
                    'entry_type' => RouteForm::class,
                ])
                ->add('infoLinks', \Symfony\Component\Form\Extension\Core\Type\CollectionType::class, [
                    'by_reference' => false,
                    'allow_add' => true,
                    'allow_delete' => true,
                    'prototype' => true,
                    'entry_type' => LinksForm::class,
                ])
                ->add('faq', \Symfony\Component\Form\Extension\Core\Type\CollectionType::class, [
                    'by_reference' => false,
                    'allow_add' => true,
                    'allow_delete' => true,
                    'prototype' => true,
                    'entry_type' => FaqForm::class,
                ])
                ->add('history', CollectionType::class, [
                    'type' => AdminType::class,
                    'by_reference' => false,
                ], [
                    'edit' => 'inline',
                    'sortable' => 'position',
                ])
                ->add('zones', ModelType::class, ['multiple' => true])
            ->end()
            ->with('Состояние', ['class' => 'col-md-3'])
                ->add('isActive')
                ->add('template', ChoiceFieldMaskType::class, [
                    'choices' => array_flip(Page::TEMPLATES),
                    'map' => [
                        Page::TEMPLATE_CONTENT => ['description', 'subTitle'],
                        Page::TEMPLATE_HISTORY => ['picture', 'history', 'subTitle'],
                        Page::TEMPLATE_INFO => ['infoLinks'],
                        Page::TEMPLATE_PLACE => ['description', 'coordinates', 'mapLink', 'howToRoute', 'picture', 'subTitle'],
                        Page::TEMPLATE_FAN => ['description', 'picture', 'zones', 'subTitle'],
                        Page::TEMPLATE_FAQ => ['subTitle', 'faq'],
                    ],
                    'required' => true
                ])
            ->end();
    }

    /**
     * @param ShowMapper $showMapper
     */
    public function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->add('id')
            ->add('title')
            ->add('slug')
            ->add('createdAt')
            ->add('updatedAt');
    }

    /**
     * @param RouteCollection $collection
     */
    protected function configureRoutes(RouteCollection $collection)
    {
        $collection
            ->add('preview')
            ->add('clone', $this->getRouterIdParameter() . '/clone');
    }

    /**
     * @return string
     */
    public function getPreviewRouteName(): string
    {
        return 'app.page';
    }

    /**
     * @param $object
     * @return array
     */
    public function getPreviewRouteParameters($object): array
    {
        if (!$object instanceof Page) {
            throw new \LogicException();
        }

        return ['slug' => $object->getSlug()];
    }
}

<?php

namespace App\Admin;

use App\Entity\Locale\LocaleInterface;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Form\Type\ModelListType;
use Sonata\AdminBundle\Route\RouteCollection;
use Sonata\AdminBundle\Show\ShowMapper;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

/**
 * Class SliderAdmin
 * @package App\Admin
 */
class SliderAdmin extends AbstractAdmin
{
    protected function configureRoutes(RouteCollection $collection)
    {
        $collection
            ->add('clone', $this->getRouterIdParameter() . '/clone');
    }

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
            ])
            ->add('isActive');
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
            ->add('sort')
            ->add('locale', 'choice', ['choices' => LocaleInterface::LOCALE_LIST])
            ->add('createdAt')
            ->add('updatedAt')
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
        $form->with('Свойства слайда', ['class' => 'col-md-9'])
                ->add('locale', ChoiceType::class, [
                    'choices' => array_flip(LocaleInterface::LOCALE_LIST)
                ])
                ->add('title')
                ->add('picture', ModelListType::class, ['required' => true], ['link_parameters' => ['context' => 'slider']])
            ->end()
            ->with('Состояние', ['class' => 'col-md-3'])
                ->add('isActive')
                ->add('sort')
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
            ->add('sort')
            ->add('isActive')
            ->add('picture')
            ->add('createdAt')
            ->add('updatedAt');
    }
}
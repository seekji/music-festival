<?php

namespace App\Admin;

use App\Entity\Locale\LocaleInterface;
use App\Entity\Menu;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

/**
 * Class MenuAdmin
 * @package App\Admin
 */
class MenuAdmin extends AbstractAdmin
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
            ->add('link')
            ->add('locale', 'choice', ['choices' => LocaleInterface::LOCALE_LIST])
            ->add('createdAt')
            ->add('updatedAt')
            ->add('_action', null, [
                'actions' => [
                    'show' => [],
                    'edit' => [],
                    'delete' => [],
                ],
            ]);
    }

    /**
     * @param FormMapper $form
     */
    protected function configureFormFields(FormMapper $form)
    {
        $form->with('Свойства ссылки', ['class' => 'col-md-9'])
                ->add('locale', ChoiceType::class, [
                    'choices' => array_flip(LocaleInterface::LOCALE_LIST)
                ])
                ->add('title')
                ->add('link')
            ->end()
            ->with('Состояние', ['class' => 'col-md-3'])
                ->add('sort')
                ->add('location', ChoiceType::class, [
                    'choices' => array_flip(Menu::LOCATION_LIST)
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
            ->add('link')
            ->add('sort')
            ->add('createdAt')
            ->add('updatedAt');
    }
}
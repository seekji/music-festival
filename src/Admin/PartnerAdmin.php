<?php

namespace App\Admin;

use App\Entity\Locale\LocaleInterface;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Form\Type\ModelListType;
use Sonata\AdminBundle\Show\ShowMapper;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

/**
 * Class PartnerAdmin
 * @package App\Admin
 */
class PartnerAdmin extends AbstractAdmin
{
    /**
     * @param DatagridMapper $filter
     */
    protected function configureDatagridFilters(DatagridMapper $filter)
    {
        $filter
            ->add('id')
            ->add('name')
            ->add('locale', null, [], ChoiceType::class, [
                'choices' => array_flip(LocaleInterface::LOCALE_LIST)
            ])
            ->add('isBig');
    }

    /**
     * @param ListMapper $list
     */
    protected function configureListFields(ListMapper $list)
    {
        unset($this->listModes['mosaic']);

        $list
            ->add('id')
            ->add('name')
            ->add('sort')
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
        $form->with('Свойства партнера', ['class' => 'col-md-9'])
                ->add('locale', ChoiceType::class, [
                    'choices' => array_flip(LocaleInterface::LOCALE_LIST)
                ])
                ->add('name')
                ->add('link')
                ->add('picture', ModelListType::class, ['required' => true], ['link_parameters' => ['context' => 'partners']])
            ->end()
            ->with('Состояние', ['class' => 'col-md-3'])
                ->add('isBig', null, ['help' => 'Список'])
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
            ->add('name')
            ->add('link')
            ->add('sort')
            ->add('isBig')
            ->add('picture')
            ->add('createdAt')
            ->add('updatedAt');
    }
}
<?php

namespace App\Admin;

use App\Entity\Locale\LocaleInterface;
use App\Entity\Page;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Form\Type\ChoiceFieldMaskType;
use Sonata\AdminBundle\Route\RouteCollection;
use Sonata\AdminBundle\Show\ShowMapper;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

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
            ->add('slug')
            ->add('locale', 'choice', ['choices' => LocaleInterface::LOCALE_LIST])
            ->add('template', 'choice', ['choices' => Page::TEMPLATES])
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
        $form
            ->with('Свойства страницы', ['class' => 'col-md-9'])
                ->add('locale', ChoiceType::class, [
                    'choices' => array_flip(LocaleInterface::LOCALE_LIST)
                ])
                ->add('template', ChoiceFieldMaskType::class, [
                    'choices' => array_flip(Page::TEMPLATES),
                    'map' => [
                        Page::TEMPLATE_CONTENT => [],
                        Page::TEMPLATE_HISTORY => [],
                        Page::TEMPLATE_INFO => [],
                        Page::TEMPLATE_PLACE => [],
                        Page::TEMPLATE_FAN => [],
                    ],
                    'required' => true
                ])
                ->add('title')
                ->add('slug')
            ->end()
            ->with('Состояние', ['class' => 'col-md-3'])
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
        $collection->add('preview');
    }

    /**
     * @return string
     */
    public function getPreviewRouteName(): string
    {
        if($this->getLocale() === LocaleInterface::LAN_EN) {
            return 'app.page.en';
        }

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

    /**
     * @return string
     */
    public function getLocale(): string
    {
        return $this->getSubject()->getLocale();
    }
}
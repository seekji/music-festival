<?php

namespace App\Form\Type;

use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Sonata\Form\Type\DatePickerType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\CallbackTransformer;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class SettingsForm extends AbstractType
{

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('ru_lineup_description', TextareaType::class, ['label' => 'Лайнап, описание', 'required' => false])
            ->add('ru_lineup_hours_description', TextareaType::class, ['label' => 'Лайнап, описание (часы)', 'required' => false])
            ->add('ru_lineup_description', TextareaType::class, ['label' => 'История, описание', 'required' => false])
            ->add('ru_lineup_link', TextType::class, ['label' => 'Лайнап, ссылка', 'required' => false])
            ->add('ru_history_description', TextareaType::class, ['label' => 'История, описание', 'required' => false])
            ->add('ru_history_views_count', TextType::class, ['label' => 'История, кол-во зрителей', 'required' => false])
            ->add('ru_history_link', TextType::class, ['label' => 'История, ссылка', 'required' => false])
            ->add('ru_history_punk_link', TextType::class, ['label' => 'История, ссылка (панк)', 'required' => false])
            ->add('ru_place_title', TextType::class, ['label' => 'Локация, заголовок', 'required' => false])
            ->add('ru_place_description', TextareaType::class, ['label' => 'Локация, описание', 'required' => false])
            ->add('ru_place_count', TextType::class, ['label' => 'Локация, кол-во фан-зон', 'required' => false])
            ->add('ru_place_link', TextType::class, ['label' => 'Локация, ссылка', 'required' => false])
            ->add('ru_address', TextType::class, ['label' => 'Адрес', 'required' => false])
            ->add('ru_phone', TextType::class, ['label' => 'Телефон', 'required' => false])
            ->add('ru_email', EmailType::class, ['label' => 'Email', 'required' => false])
            ->add('ru_email', EmailType::class, ['label' => 'Email', 'required' => false])
            ->add('ru_popup_title', TextType::class, ['label' => 'Popup-заголовок', 'required' => false])
            ->add('ru_popup_sub_title', TextType::class, ['label' => 'Popup-подзаголовок', 'required' => false])
            ->add('ru_popup_description', CKEditorType::class, ['label' => 'Popup-описание', 'config' => ['toolbar' => 'basic'], 'required' => false])
        ;

        $builder
            ->add('en_lineup_description', TextareaType::class, ['label' => 'Лайнап, описание', 'required' => false])
            ->add('en_lineup_hours_description', TextareaType::class, ['label' => 'Лайнап, описание (часы)', 'required' => false])
            ->add('en_lineup_link', TextType::class, ['label' => 'Лайнап, ссылка', 'required' => false])
            ->add('en_history_description', TextareaType::class, ['label' => 'История, описание', 'required' => false])
            ->add('en_history_views_count', TextType::class, ['label' => 'История, кол-во зрителей', 'required' => false])
            ->add('en_history_link', TextType::class, ['label' => 'История, ссылка', 'required' => false])
            ->add('en_history_punk_link', TextType::class, ['label' => 'История, ссылка (панк)', 'required' => false])
            ->add('en_place_title', TextType::class, ['label' => 'Локация, заголовок', 'required' => false])
            ->add('en_place_description', TextareaType::class, ['label' => 'Локация, описание', 'required' => false])
            ->add('en_place_count', TextType::class, ['label' => 'Локация, кол-во фан-зон', 'required' => false])
            ->add('en_place_link', TextType::class, ['label' => 'Локация, ссылка', 'required' => false])
            ->add('en_address', TextType::class, ['label' => 'Адрес', 'required' => false])
            ->add('en_phone', TextType::class, ['label' => 'Телефон', 'required' => false])
            ->add('en_email', EmailType::class, ['label' => 'Email', 'required' => false])
            ->add('en_popup_title', TextType::class, ['label' => 'Popup-заголовок', 'required' => false])
            ->add('en_popup_sub_title', TextType::class, ['label' => 'Popup-подзаголовок', 'required' => false])
            ->add('en_popup_description', CKEditorType::class, ['label' => 'Popup-описание', 'config' => ['toolbar' => 'basic'], 'required' => false])
        ;

        $builder
            ->add('event_start_date', DatePickerType::class, ['label' => 'Дата начала мероприятия', 'required' => false])
            ->add('event_hours', IntegerType::class, ['label' => 'Длительность мероприятия (часы)', 'required' => false])
            ->add('tickets_link', TextType::class, ['label' => 'Ссылка на билеты', 'required' => false])
            ->add('vk', TextType::class, ['label' => 'VK', 'required' => false, 'help' => 'Ссылка на группу.'])
            ->add('facebook', TextType::class, ['label' => 'Facebook', 'required' => false, 'help' => 'Ссылка на группу.'])
            ->add('instagram', TextType::class, ['label' => 'Instagram', 'required' => false, 'help' => 'Ссылка на профиль.'])
            ->add('youtube', TextType::class, ['label' => 'YouTube', 'required' => false]);

        $builder->get('event_start_date')
            ->addModelTransformer(new CallbackTransformer(
                function ($date) {
                    return (new \DateTime($date));
                },
                function ($date) {
                    return  $date->format('Y-m-d');
                }
            ))
        ;
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(
            [
                'data_class' => null,
                'allow_extra_fields' => true,
                'csrf_protection' => false,
            ]
        );
    }
}

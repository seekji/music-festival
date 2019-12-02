<?php

namespace App\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
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
            ->add('address', TextType::class, ['label' => 'Адрес', 'required' => false])
            ->add('phone', TextType::class, ['label' => 'Телефон', 'required' => false])
            ->add('email', EmailType::class, ['label' => 'Email', 'required' => false])
            ->add('personal_rules_link', TextType::class, ['label' => 'Ссылка на страницу с правилами обработки персональных данных', 'required' => false])
            ->add('vk', TextType::class, ['label' => 'VK', 'required' => false, 'help' => 'Ссылка на группу.'])
            ->add('facebook', TextType::class, ['label' => 'Facebook', 'required' => false, 'help' => 'Ссылка на группу.'])
            ->add('instagram', TextType::class, ['label' => 'Instagram', 'required' => false, 'help' => 'Ссылка на профиль.'])
            ->add('city_count', IntegerType::class, ['label' => 'Кол-во городов', 'required' => false])
            ->add('hall_count', IntegerType::class, ['label' => 'Кол-во площадок', 'required' => false])
            ->add('event_count', IntegerType::class, ['label' => 'Кол-во мероприятий в год', 'required' => false])
            ->add('email_send_from', EmailType::class, ['label' => 'Отправлять заявки с форм от:', 'required' => false])
            ->add('email_send_to', EmailType::class, ['label' => 'Отправлять завяки с форм на:', 'required' => false]);
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

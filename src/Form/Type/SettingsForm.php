<?php

namespace App\Form\Type;

use Sonata\Form\Type\DatePickerType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\CallbackTransformer;
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
            ->add('ru_address', TextType::class, ['label' => 'Адрес', 'required' => false])
            ->add('ru_phone', TextType::class, ['label' => 'Телефон', 'required' => false])
            ->add('ru_email', EmailType::class, ['label' => 'Email', 'required' => false])
            ->add('ru_email', EmailType::class, ['label' => 'Email', 'required' => false]);

        $builder
            ->add('en_address', TextType::class, ['label' => 'Адрес', 'required' => false])
            ->add('en_phone', TextType::class, ['label' => 'Телефон', 'required' => false])
            ->add('en_email', EmailType::class, ['label' => 'Email', 'required' => false])
            ->add('en_email', EmailType::class, ['label' => 'Email', 'required' => false]);

        $builder
            ->add('eventStartDate', DatePickerType::class, ['label' => 'Дата начала мероприятия', 'required' => false])
            ->add('vk', TextType::class, ['label' => 'VK', 'required' => false, 'help' => 'Ссылка на группу.'])
            ->add('facebook', TextType::class, ['label' => 'Facebook', 'required' => false, 'help' => 'Ссылка на группу.'])
            ->add('instagram', TextType::class, ['label' => 'Instagram', 'required' => false, 'help' => 'Ссылка на профиль.']);

        $builder->get('eventStartDate')
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

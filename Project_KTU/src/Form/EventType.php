<?php

namespace App\Form;

use App\Entity\Event;
use phpDocumentor\Reflection\Types\This;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type;

class EventType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('Title', TextType::class)
            ->add('Category', TextType::class)
            ->add('City', TextType::class)
            ->add('Address', TextType::class)
            ->add('Place', TextType::class)
            ->add('Date', Type\DateType::class, [
                'format' => 'yyyyMMdd'
            ])
            ->add('Time', Type\TimeType::class)
            ->add('Duration', Type\TimeType::class)
            ->add('Price', Type\MoneyType::class)
            ->add('Description', Type\TextareaType::class)
            ->add('Creator', EntityType::class, [
                'class' => \App\Entity\User::class,
                'choice_label' => 'email',
                'disabled' => true
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Event::class,
        ]);
    }
}

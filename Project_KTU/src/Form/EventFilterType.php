<?php
/**
 * Created by PhpStorm.
 * User: Evaldas
 * Date: 14/05/2019
 * Time: 15:27
 */

namespace App\Form;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EventFilterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('Title', TextType::class, [
                'label' => "Pavadinimas",
                'attr' => ['placeholder' => "Renginio pavadinimas"],

            ])
            ->add('Category', TextType::class, [
                'label' => "Kategorija",
                'attr' => ['placeholder' => "Renginio kategorija"],

            ])
            ->add('Date', Type\DateType::class, [
                'label' => "Data",
                'format' => 'yyyyMMdd',
                'placeholder' => [
                    'year' => 'Year', 'month' => 'Month', 'day' => 'Day',
                ]
            ])
            ->add('Price_from', Type\MoneyType::class, [
                'label' => "Kaina nuo",
                'attr' => ['placeholder' => "Kaina nuo"],
            ])
            ->add('Price_up_to', Type\MoneyType::class, [
                'label' => "Kaina iki",
                'attr' => ['placeholder' => "Kaina iki"],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => null,
        ]);
    }

}
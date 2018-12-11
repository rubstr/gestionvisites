<?php

namespace App\Form;

use App\Entity\PropertySearch;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class PropertySearchType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('search', TextType::class, [
                'attr' => [
                    'class' => 'input is-hovered',
                    'placeholder' => 'Rechercher par le nom ou le dépot légal',
                ],
                'label' => false,
                'required' => false
                ])
            ->add('dateSearch',TextType::class, [
                'required' => false,
                'label' => false,
                'attr' => [
                    'class' => 'input is-hovered has-text-black',
                    'placeholder' => "Date d'ajout du médicament",
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => PropertySearch::class,
            'method' => 'get',
            'csrf_protection' => false
            
        ]);
    }
    public  function getBlockPrefix()
    {
        return '';
    }
}

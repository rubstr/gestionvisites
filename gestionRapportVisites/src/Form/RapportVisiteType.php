<?php

namespace App\Form;

use App\Entity\Praticien;
use App\Entity\RapportVisite;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class RapportVisiteType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            /*->add('rap_date')*/
            ->add('rap_bilan', TextareaType::class, [
                'attr' => [
                    'class' => 'textarea',
                    'placeholder' => 'bilan du rapport'
                ],
                'label' => 'Bilan'
            ])
            ->add('rap_motif', TextType::class,[
                'attr' => [
                    'class' => 'input',
                    'placeholder' => 'Motif du rapport'
                ],
                'label' => 'Motif'
            ])
            /*->add('visiteur')*/
            ->add('praticien', EntityType::class,[
                'class' => Praticien::class,
                'attr' => [
                    'class' => 'select is-medium is-rounded',
                    'placeholder' => 'Motif du rapport'
                ],
                'label' => 'Motif'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => RapportVisite::class,
        ]);
    }
}

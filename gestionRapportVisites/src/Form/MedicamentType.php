<?php

namespace App\Form;

use App\Entity\Medicament;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class MedicamentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('med_depot_legal', TextType::class,[
                'attr' => [
                    'class' => 'input',
                    'placeholder' => 'Depot legal'
                ],
                'label' => 'Depot legal'
            ])
            // ->add('date_ajout')
            ->add('libelle', TextType::class,[
                'attr' => [
                    'class' => 'input',
                    'placeholder' => 'libelle'
                ],
                'label' => 'Libelle'
            ])
            ->add('description', TextType::class,[
                'attr' => [
                    'class' => 'input',
                    'placeholder' => 'Description'
                ],
                'label' => 'Description'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Medicament::class,
        ]);
    }
}

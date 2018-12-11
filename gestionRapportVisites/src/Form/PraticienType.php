<?php

namespace App\Form;

use App\Entity\Praticien;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class PraticienType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('pra_nom', TextType::class,[
                'attr' => [
                    'class' => 'input',
                    'placeholder' => 'Nom du praticien'
                ],
                'label' => 'Nom'
            ])
            ->add('pra_prenom', TextType::class,[
                'attr' => [
                    'class' => 'input',
                    'placeholder' => 'Prenom du praticien'
                ],
                'label' => 'Prenom'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Praticien::class,
        ]);
    }
}

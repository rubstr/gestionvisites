<?php

namespace App\Form;

use App\Entity\Inviter;
use App\Entity\Praticien;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class InviterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('praticien', EntityType::class, array(
                'class' => Praticien::class,
                // 'query_builder' => function (EntityRepository $er) {
                //     return $er->createQueryBuilder('u')
                //         ->orderBy('u.username', 'ASC');
                // },
                // 'choice_label' => 'pra_prenom',
            ))
            // ->add('activiteCompl')
            ->add('specialisation')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Inviter::class,
        ]);
    }
}

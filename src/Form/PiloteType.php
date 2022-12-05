<?php

namespace App\Form;

use App\Entity\Pilote;
use App\Entity\Qualification;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;

class PiloteType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom', TextType::class, [
            ])
            ->add('prenom', TextType::class, [
            ])
            ->add('email', EmailType::class, [
            ])
            ->add('qualification', EntityType::class, [
                'class' => Qualification::class,
                'choice_label' => function ($qualification) {
                    return $qualification->getCode() . ' - ' . $qualification->getLibelle();
                },
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Pilote::class,
        ]);
    }
}

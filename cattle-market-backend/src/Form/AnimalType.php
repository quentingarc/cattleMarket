<?php

namespace App\Form;

use App\Entity\Animal;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AnimalType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Nom'
            ])
            ->add('age', NumberType::class, [
                'label' => 'Âge'
            ])
            ->add('type', ChoiceType::class, [
                'choices' => [
                    'Chien' => 'chien',
                    'Cheval' => 'cheval',
                    'Brebis' => 'brebis',
                    'Cochon' => 'cochon'
                ],
                'label' => 'Type'
            ])
            ->add('race', TextType::class, [
                'label' => 'Race'
            ])
            ->add('description', TextareaType::class, [
                'label' => 'Description'
            ])
            ->add('priceHt', NumberType::class, [
                'label' => 'Prix HT'
            ])
            ->add('status', ChoiceType::class, [
                'choices' => [
                    'En vente' => 'en vente',
                    'Vendu' => 'vendu'
                ],
                'label' => 'Statut'
            ])
            ->add('photos', TextType::class, [
                'label' => 'Photos (URL)'
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Animal::class,
        ]);
    }
}


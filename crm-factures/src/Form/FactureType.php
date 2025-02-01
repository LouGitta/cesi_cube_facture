<?php

namespace App\Form;

use App\Entity\Client;
use App\Entity\Ligne;
use App\Entity\Facture;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FactureType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('num')
            ->add('nb_jour')
            ->add('crea', null, [
                'widget' => 'single_text',
            ])
            ->add('name')
            ->add('info')
            ->add('sent', null, [
                'widget' => 'single_text',
            ])
            ->add('payed', null, [
                'widget' => 'single_text',
            ])
            ->add('tva')
            ->add('ttc')
            ->add('ht')
            ->add('client', EntityType::class, [
                'class' => Client::class,
                'choice_label' => 'name',
            ])
            ->add('lignes', CollectionType::class, [
                'entry_type' => LigneType::class,  // Assurez-vous de créer le formulaire LigneType
                'entry_options' => ['label' => false],
                'allow_add' => true,
                'by_reference' => false,
                'prototype' => true,
                'prototype_name' => '__name__',  // Nom pour la ligne dynamique
                'attr' => ['class' => 'lignes-collection'],
            ]);
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Facture::class,
        ]);
    }
}

<?php

namespace App\Form;

use App\Entity\Client;
use App\Entity\Facture;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
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
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Facture::class,
        ]);
    }
}

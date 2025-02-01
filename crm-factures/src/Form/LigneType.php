<?php

namespace App\Form;

// use App\Entity\Facture;
use App\Entity\Ligne;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class LigneType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('info1')
            ->add('info2')
            ->add('info3')
            ->add('prix')
            ->add('quantite')
            // ->add('total')
            // ->add('facture', EntityType::class, [
            //     'class' => Facture::class,
            //     'choice_label' => 'id',
            // ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Ligne::class,
        ]);
    }
}

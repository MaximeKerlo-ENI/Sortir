<?php

namespace App\Form;

use App\Entity\Lieux;
use App\Entity\Villes;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class LieuxType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nomLieu')
            ->add('rue')
            ->add('latitude')
            ->add('longitude')
            ->add('villes', EntityType::class, [
                "label" => "Ville de la sortie",
                "class" => Villes::class,
                "choice_label" => function ($villesNoVilles) {
                    return $villesNoVilles->getCodePostal()." - ".$villesNoVilles->getNomVille();
                },
                "mapped"=>false
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Lieux::class,
        ]);
    }
}

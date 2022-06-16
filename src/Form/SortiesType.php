<?php

namespace App\Form;

use App\Entity\Lieux;
use App\Entity\Participants;
use App\Entity\Sites;
use App\Entity\Sorties;
use App\Entity\Villes;
use DateTime;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Date;

class SortiesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom', TextType::class, ["label" => "Nom"]) //changer les titres + mettre les calendriers
            ->add('datedebut', DateType::class, ["label" => "Débute le ...", "widget" => "single_text"])
            ->add('duree', IntegerType::class, ["label" => "Durée"])
            ->add('datecloture', DateType::class, ["label" => "Date de cloture des inscriptions", "widget" => "single_text"])
            ->add('nbinscriptionsmax', IntegerType::class, ["label" => "Nombre maximum d'inscriptions"])
            ->add('descriptioninfos', TextareaType::class, ["label" => "Description de l'activité"])
            ->add('villes', EntityType::class, [
                "label" => "Ville",
                "class" => Villes::class,
                "choice_label" => function ($villes) {
                    return $villes->getNomVille();
                },
                'mapped' => false
            ])
            ->add('lieuxNoLieu', EntityType::class, [
                "label" => "Lieu de la sortie",
                "class" => Lieux::class,
                "choice_label" => function ($lieuxNoLieu) {
                    return $lieuxNoLieu->getNomLieu();
                },
                'mapped' => false
            ])
            ->add('rueLieu', EntityType::class, [
                "label" => "Rue",
                "class" => Lieux::class,
                "choice_label" => function ($rueLieu) {
                    return $rueLieu->getRue();
                },
                'mapped' => false
            ])
            ->add('codePostal', EntityType::class, [
                "label" => "Code postal",
                "class" => Lieux::class,
                "choice_label" => function ($codePostal) {
                    return $codePostal->getVillesNoVille()->getCodePostal();
                },
                'mapped' => false
            ])
            ->add('latitude', IntegerType::class,["label"=>"Latitude"])
            
            ->add('longitude', EntityType::class, [
                "label" => "Longitude",
                "class" => Lieux::class,
                "choice_label" => function ($longitude) {
                    return $longitude->getLongitude();
                },
                'mapped' => false
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Sorties::class,
        ]);
    }
}

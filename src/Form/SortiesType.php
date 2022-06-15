<?php

namespace App\Form;

use App\Entity\Lieux;
use App\Entity\Participants;
use App\Entity\Sites;
use App\Entity\Sorties;
use DateTime;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
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
            ->add('datedebut', DateType::class, ["label" => "Date de début", "widget" => "single_text"])
            ->add('duree', NumberType::class, ["label" => "Durée"])
            ->add('datecloture', DateType::class, ["label" => "Date de cloture des inscriptions", "widget" => "single_text"])
            ->add('nbinscriptionsmax', NumberType::class, ["label" => "Nombre maximum d'inscriptions"])
            ->add('descriptioninfos', TextareaType::class, ["label" => "Description de l'activité"])
            ->add('etatsortie')
            ->add('urlphoto')
            // ->add('sitesNoSite', EntityType::class,["class"=>Sites::class])
            // ->add('etatsNoEtat')
            ->add('organisateur')
            ->add('lieuxNoLieu', EntityType::class, [
                "label" =>"Lieu de la sortie",
                "class" => Lieux::class,
                "choice_label" => function ($lieuxNoLieu) {
                    return $lieuxNoLieu->getVillesNoVille()->getNomVille();
                }
            ])
            // ->add('participantsNoParticipant',EntityType::class,["class"=>Participants::class])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Sorties::class,
        ]);
    }
}

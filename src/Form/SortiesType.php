<?php

namespace App\Form;

use App\Entity\Lieux;
use App\Entity\Sorties;
use DateTime;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SortiesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom')//changer les titres + mettre les calendriers
            ->add('datedebut', DateType::class)
            ->add('duree')
            ->add('datecloture',DateType::class)
            ->add('nbinscriptionsmax')
            ->add('descriptioninfos', TextareaType::class)
            ->add('etatsortie')
            ->add('urlphoto')
            // ->add('sitesNoSite')
            // ->add('etatsNoEtat')
            ->add('organisateur')
            ->add('lieuxNoLieu', EntityType::class,[
                "class"=>Lieux::class,
                "choice_label"=>function ($lieuxNoLieu){
                    return $lieuxNoLieu->getVillesNoVille()->getNomVille();
                }
            ])
            // ->add('participantsNoParticipant')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Sorties::class,
        ]);
    }
}

<?php

namespace App\Form;

use App\Entity\Participants;
use App\Entity\Sites;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ParticipantsEditType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {   
        
        $builder
            ->add('nom')
            ->add('prenom')
            ->add('telephone')
            ->add('mail')
            ->add('actif')
            ->add('sitesNoSite', EntityType::class, [
                "class" => Sites::class,
                "choice_label" => function ($site) {
                    return $site->getNomSite();
                }
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Participants::class,
        ]);
    }
}

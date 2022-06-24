<?php

namespace App\Controller;

use App\Entity\Inscriptions;
use App\Entity\Participants;
use App\Entity\Sorties;
use App\Form\ParticipantsType;
use App\Form\SortiesType;
use App\Repository\EtatsRepository;
use App\Repository\InscriptionsRepository;
use App\Repository\LieuxRepository;

use App\Repository\ParticipantsRepository;
use App\Repository\SitesRepository;
use App\Repository\SortiesRepository;
use App\Service\Methodes;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;

class MainController extends AbstractController
{
    /**
     * @Route("/",name="app_accueil")
     */
    public function liste(SortiesRepository $sr, SitesRepository $siteR, EtatsRepository $er, ParticipantsRepository $pr, InscriptionsRepository $ir, Methodes $methodes): Response
    {


        /** @var \App\Entity\Participants $user */
        $user = $this->getUser();
            if ($user != null) {
                $no = $user->getNoParticipant();
                $listesorties = $sr->findAll();
                $tab = array();
                foreach ($listesorties as $ele) {
                    $participants = $methodes->participants($ele->getNoSortie(), $ir);
                    $boutonValue = $methodes->participe($ele->getNoSortie(), $no, $ir);
                    $sortie = array(
                        "nom" => $ele->getNom(),
                        "datedebut" => $ele->getDatedebut(),
                        "datecloture" => $ele->getDatecloture(),
                        "nbparticipants" => $participants,
                        "nbinscriptionsmax" => $ele->getNbinscriptionsmax(),
                        "etatsnoetats" => $ele->getEtatsNoEtat()->getNoEtat(),
                        "organisateur" => $ele->getOrganisateur()->getNom(),
                        "nosortie" => $ele->getNoSortie(),
                        "bouton" => $boutonValue
                    );
                    array_push($tab,$sortie);
                }

                // $tab[] = $sortie;
                
            } else {
                $listesorties = $sr->findAll();
                $tab = array();
                foreach ($listesorties as $ele) {
                    $participants = $methodes->participants($ele->getNoSortie(), $ir);
                    // $boutonValue = $methodes->participe($ele->getNoSortie(), $no, $ir);
                    $sortie = array(
                        "nom" => $ele->getNom(),
                        "datedebut" => $ele->getDatedebut(),
                        "datecloture" => $ele->getDatecloture(),
                        "nbparticipants" => $participants,
                        "nbinscriptionsmax" => $ele->getNbinscriptionsmax(),
                        "etatsnoetats" => $ele->getEtatsNoEtat()->getNoEtat(),
                        "organisateur" => $ele->getOrganisateur()->getNom(),
                        "nosortie" => $ele->getNoSortie(),

                        "bouton" => false
                    );
                }

                $tab[] = $sortie;
                // array_push($tab,$sortie);
            }
        

        return $this->render("sorties/liste.html.twig",
            [   
                'inscriptions' => $ir->findAll(),
                'sorty' => $sr->findAll(),
                "etats" => $er->findAll(),
                "organisateur" => $pr->findAll(),
                "sites" => $siteR->findAll(),
                "tab" => $tab
            ]
        );
    }
}

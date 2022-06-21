<?php

namespace App\Controller;

use App\Entity\Participants;
use App\Entity\Sorties;
use App\Form\ParticipantsType;
use App\Form\SortiesType;
use App\Repository\EtatsRepository;

use App\Repository\LieuxRepository;

use App\Repository\ParticipantsRepository;
use App\Repository\SitesRepository;
use App\Repository\SortiesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{


        /**
        * @Route("/",name="app_accueil")
        */
        public function liste(SortiesRepository $sr, SitesRepository $siteR, EtatsRepository $er, ParticipantsRepository $pr):Response{
            
            return $this->render("sorties/liste.html.twig",
            ["sorties"=>$sr->findAll(),
             "etats"=>$er->findAll(),
             "organisateur"=>$pr->findAll(),
             "sites"=>$siteR->findAll()]);
        }
    }


<?php

    namespace App\Controller;

use App\Entity\Participants;
use App\Entity\Sorties;
use App\Form\ParticipantsType;
use App\Form\SortiesType;
use App\Repository\ParticipantsRepository;
use App\Repository\SortiesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
    use Symfony\Component\Routing\Annotation\Route;

    class MainController extends AbstractController{

        /**
        * @Route("/",name="app_home")
        */
        public function index(): Response
        {
            return $this->render("layouts/base.html.twig");
        }
    }
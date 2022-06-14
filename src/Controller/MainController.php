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
        public function nouveauSouhait(Request $request, SortiesRepository $sr): Response
        {
                $sortie = new Sorties();
                $sortieForm = $this->createForm(SortiesType::class, $sortie);
                $sortieForm->handleRequest($request);
    
                if ($sortieForm->isSubmitted() && $sortieForm->isValid()) {
                    $sr->add($sortie, true);
                    return $this->redirectToRoute("app_home");
                }
    
                return $this->render(
                    "sorties/new.html.twig",
                    ["form" => $sortieForm->createView()]
                );
            }
    }
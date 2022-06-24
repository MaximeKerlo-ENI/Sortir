<?php

namespace App\Controller;

use App\Entity\Inscriptions;
use App\Entity\Participants;
use App\Entity\Sorties;
use App\Form\InscriptionsType;
use App\Repository\InscriptionsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
/**
 * @Route("/inscriptions")
 */
class InscriptionsController extends AbstractController
{
    /**
     * @Route("/", name="app_inscriptions_index", methods={"GET"})
     */
    public function index(InscriptionsRepository $inscriptionsRepository): Response
    {
        return $this->render('inscriptions/index.html.twig', [
            'inscriptions' => $inscriptionsRepository->findAll(),
        ]);
    }

    /**
     * @Route("/{noSortie}/{noParticipant}", name="app_inscription", methods={"GET", "POST"})
     *
     * @ParamConverter("sorty", class=Sorties::class)
     * @ParamConverter("user", class=Participants::class)
     *
     * @Template()
     */
    public function new(InscriptionsRepository $inscriptionsRepository, Sorties $sorty, Participants $user): Response
    {
        $inscription = new Inscriptions();
        $inscription->setSortiesNoSortie($sorty);
        $inscription->setParticipantsNoParticipant($user);
        $inscription->setDateInscription(new \DateTime('@'.strtotime('now')));
        $inscriptionsRepository->add($inscription, true);

        return $this->redirectToRoute('app_sorties_show', ['noSortie' => $sorty->getNoSortie()], Response::HTTP_SEE_OTHER);

    }

    /**
     * @Route("/{id}", name="app_inscriptions_show", methods={"GET"})
     */
    public function show(Inscriptions $inscription): Response
    {
        return $this->render('inscriptions/show.html.twig', [
            'inscription' => $inscription,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_inscriptions_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Inscriptions $inscription, InscriptionsRepository $inscriptionsRepository): Response
    {
        $form = $this->createForm(InscriptionsType::class, $inscription);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $inscriptionsRepository->add($inscription, true);

            return $this->redirectToRoute('app_inscriptions_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('inscriptions/edit.html.twig', [
            'inscription' => $inscription,
            'form' => $form,
        ]);
    }

   /**
     * @Route("/delete/{noSortie}/{noParticipant}", name="app_inscription_delete", methods={"GET", "POST"})
     *
     * @ParamConverter("sorty", class=Sorties::class)
     * @ParamConverter("user", class=Participants::class)
     *
     * @Template()
     */
    public function delete(InscriptionsRepository $ir, Sorties $sorty, Participants $user): Response
    {
        $inscription = new Inscriptions();
        $sorties = $ir->findBySortie($sorty);
        foreach ($sorties as $ele) {
            if($ele->getParticipantsNoParticipant() == $user){
                $inscription = $ele;
            }
       }

        $ir->remove($inscription, true);

        return $this->redirectToRoute('app_sorties_show', ['noSortie' => $sorty->getNoSortie()], Response::HTTP_SEE_OTHER);
    }
}

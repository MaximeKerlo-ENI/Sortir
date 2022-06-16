<?php

namespace App\Controller;

use App\Entity\Participants;
use App\Form\Participants1Type;
use App\Form\ParticipantsAdminEditType;
use App\Form\ParticipantsEditType;
use App\Repository\ParticipantsRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/participants")
 */
class ParticipantsController extends AbstractController
{
    /**
     * @IsGranted("ROLE_ADMIN")
     * 
     * @Route("/", name="app_participants_index", methods={"GET"})
     */
    public function index(ParticipantsRepository $participantsRepository): Response
    {
        return $this->render('participants/index.html.twig', [
            'participants' => $participantsRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="app_participants_new", methods={"GET", "POST"})
     */
    public function new(Request $request, ParticipantsRepository $participantsRepository): Response
    {
        $participant = new Participants();
        $form = $this->createForm(Participants1Type::class, $participant);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $participantsRepository->add($participant, true);

            return $this->redirectToRoute('app_participants_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('participants/new.html.twig', [
            'participant' => $participant,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{noParticipant}", name="app_participants_show", methods={"GET"})
     */
    public function show(Participants $participant): Response
    {
        return $this->render('participants/show.html.twig', [
            'participant' => $participant,
        ]);
    }

    /**
     * @Route("/{noParticipant}/edit", name="app_participants_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Participants $participant, ParticipantsRepository $participantsRepository): Response
    {
        $form = $this->createForm(ParticipantsEditType::class, $participant);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $participantsRepository->add($participant, true);
            $noparticipant = $participant->getNoParticipant();
            return $this->redirectToRoute('app_participants_edit', ['noParticipant' => $noparticipant], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('participants/edit.html.twig', [
            'participant' => $participant,
            'form' => $form,
        ]);
    }

    /**
     * @IsGranted("ROLE_ADMIN")
     * 
     * @Route("/{noParticipant}/adminedit", name="app_participants_adminedit", methods={"GET", "POST"})
     */
    public function adminEdit(Request $request, Participants $participant, ParticipantsRepository $participantsRepository): Response
    {
        $form = $this->createForm(ParticipantsAdminEditType::class, $participant);
        $form->handleRequest($request);
    
        if ($form->isSubmitted() && $form->isValid()) {
            $participantsRepository->add($participant, true);
    
        
            return $this->redirectToRoute('app_participants_index', [], Response::HTTP_SEE_OTHER);
        }
        
        return $this->renderForm('participants/adminedit.html.twig', [
            'participant' => $participant,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{noParticipant}", name="app_participants_delete", methods={"POST"})
     */
    public function delete(Request $request, Participants $participant, ParticipantsRepository $participantsRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$participant->getNoParticipant(), $request->request->get('_token'))) {
            $participantsRepository->remove($participant, true);
        }

        return $this->redirectToRoute('app_accueil', [], Response::HTTP_SEE_OTHER);
    }
}

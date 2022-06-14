<?php

namespace App\Controller;

use App\Entity\Participants;
use App\Form\ParticipantsType;
use App\Repository\ParticipantsRepository;
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
     * @Route("/", name="app_participants_index", methods={"GET"})
     */
    public function index(ParticipantsRepository $participantsRepository): Response
    {
        return $this->render('participants/index.html.twig', [
            'participants' => $participantsRepository->findAll(),
        ]);
    }

    /**
     * @Route("/inscription", name="app_inscription", methods={"GET", "POST"})
     */
    public function new(Request $request, ParticipantsRepository $participantsRepository): Response
    {
        $participant = new Participants();
        $form = $this->createForm(ParticipantsType::class, $participant);
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
        $form = $this->createForm(ParticipantsType::class, $participant);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $participantsRepository->add($participant, true);

            return $this->redirectToRoute('app_participants_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('participants/edit.html.twig', [
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

        return $this->redirectToRoute('app_participants_index', [], Response::HTTP_SEE_OTHER);
    }
}

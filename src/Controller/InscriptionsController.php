<?php

namespace App\Controller;

use App\Entity\Inscriptions;
use App\Form\InscriptionsType;
use App\Repository\InscriptionsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

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
     * @Route("/new", name="app_inscriptions_new", methods={"GET", "POST"})
     */
    public function new(Request $request, InscriptionsRepository $inscriptionsRepository): Response
    {
        $inscription = new Inscriptions();
        $form = $this->createForm(InscriptionsType::class, $inscription);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $inscriptionsRepository->add($inscription, true);

            return $this->redirectToRoute('app_inscriptions_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('inscriptions/new.html.twig', [
            'inscription' => $inscription,
            'form' => $form,
        ]);
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
     * @Route("/{id}", name="app_inscriptions_delete", methods={"POST"})
     */
    public function delete(Request $request, Inscriptions $inscription, InscriptionsRepository $inscriptionsRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$inscription->getId(), $request->request->get('_token'))) {
            $inscriptionsRepository->remove($inscription, true);
        }

        return $this->redirectToRoute('app_inscriptions_index', [], Response::HTTP_SEE_OTHER);
    }
}

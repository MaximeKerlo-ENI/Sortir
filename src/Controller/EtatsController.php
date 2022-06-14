<?php

namespace App\Controller;

use App\Entity\Etats;
use App\Form\EtatsType;
use App\Repository\EtatsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/etats")
 */
class EtatsController extends AbstractController
{
    /**
     * @Route("/", name="app_etats_index", methods={"GET"})
     */
    public function index(EtatsRepository $etatsRepository): Response
    {
        return $this->render('etats/index.html.twig', [
            'etats' => $etatsRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="app_etats_new", methods={"GET", "POST"})
     */
    public function new(Request $request, EtatsRepository $etatsRepository): Response
    {
        $etat = new Etats();
        $form = $this->createForm(EtatsType::class, $etat);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $etatsRepository->add($etat, true);

            return $this->redirectToRoute('app_etats_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('etats/new.html.twig', [
            'etat' => $etat,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{noEtat}", name="app_etats_show", methods={"GET"})
     */
    public function show(Etats $etat): Response
    {
        return $this->render('etats/show.html.twig', [
            'etat' => $etat,
        ]);
    }

    /**
     * @Route("/{noEtat}/edit", name="app_etats_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Etats $etat, EtatsRepository $etatsRepository): Response
    {
        $form = $this->createForm(EtatsType::class, $etat);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $etatsRepository->add($etat, true);

            return $this->redirectToRoute('app_etats_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('etats/edit.html.twig', [
            'etat' => $etat,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{noEtat}", name="app_etats_delete", methods={"POST"})
     */
    public function delete(Request $request, Etats $etat, EtatsRepository $etatsRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$etat->getNoEtat(), $request->request->get('_token'))) {
            $etatsRepository->remove($etat, true);
        }

        return $this->redirectToRoute('app_etats_index', [], Response::HTTP_SEE_OTHER);
    }
}

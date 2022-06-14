<?php

namespace App\Controller;

use App\Entity\Sorties;
use App\Form\SortiesType;
use App\Repository\SortiesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/sorties")
 */
class SortiesController extends AbstractController
{
    /**
     * @Route("/", name="app_sorties_index", methods={"GET"})
     */
    public function index(SortiesRepository $sortiesRepository): Response
    {
        return $this->render('sorties/index.html.twig', [
            'sorties' => $sortiesRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="app_sorties_new", methods={"GET", "POST"})
     */
    public function new(Request $request, SortiesRepository $sortiesRepository): Response
    {
        $sorty = new Sorties();
        $form = $this->createForm(SortiesType::class, $sorty);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $sortiesRepository->add($sorty, true);

            return $this->redirectToRoute('app_sorties_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('sorties/new.html.twig', [
            'sorty' => $sorty,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{noSortie}", name="app_sorties_show", methods={"GET"})
     */
    public function show(Sorties $sorty): Response
    {
        return $this->render('sorties/show.html.twig', [
            'sorty' => $sorty,
        ]);
    }

    /**
     * @Route("/{noSortie}/edit", name="app_sorties_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Sorties $sorty, SortiesRepository $sortiesRepository): Response
    {
        $form = $this->createForm(SortiesType::class, $sorty);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $sortiesRepository->add($sorty, true);

            return $this->redirectToRoute('app_sorties_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('sorties/edit.html.twig', [
            'sorty' => $sorty,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{noSortie}", name="app_sorties_delete", methods={"POST"})
     */
    public function delete(Request $request, Sorties $sorty, SortiesRepository $sortiesRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$sorty->getNoSortie(), $request->request->get('_token'))) {
            $sortiesRepository->remove($sorty, true);
        }

        return $this->redirectToRoute('app_sorties_index', [], Response::HTTP_SEE_OTHER);
    }
}
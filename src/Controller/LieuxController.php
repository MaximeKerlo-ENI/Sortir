<?php

namespace App\Controller;

use App\Entity\Lieux;
use App\Form\LieuxType;
use App\Repository\LieuxRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/lieux")
 */
class LieuxController extends AbstractController
{
    /**
     * @Route("/", name="app_lieux_index", methods={"GET"})
     */
    public function index(LieuxRepository $lieuxRepository): Response
    {
        return $this->render('lieux/index.html.twig', [
            'lieuxes' => $lieuxRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="app_lieux_new", methods={"GET", "POST"})
     */
    public function new(Request $request, LieuxRepository $lieuxRepository): Response
    {
        $lieux = new Lieux();
        $form = $this->createForm(LieuxType::class, $lieux);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $lieuxRepository->add($lieux, true);

            return $this->redirectToRoute('app_sorties_new', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('lieux/new.html.twig', [
            'lieux' => $lieux,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{noLieu}", name="app_lieux_show", methods={"GET"})
     */
    public function show(Lieux $lieux): Response
    {
        return $this->render('lieux/show.html.twig', [
            'lieux' => $lieux,
        ]);
    }

    /**
     * @Route("/{noLieu}/edit", name="app_lieux_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Lieux $lieux, LieuxRepository $lieuxRepository): Response
    {
        $form = $this->createForm(LieuxType::class, $lieux);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $lieuxRepository->add($lieux, true);

            return $this->redirectToRoute('app_lieux_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('lieux/edit.html.twig', [
            'lieux' => $lieux,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{noLieu}", name="app_lieux_delete", methods={"POST"})
     */
    public function delete(Request $request, Lieux $lieux, LieuxRepository $lieuxRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$lieux->getNoLieu(), $request->request->get('_token'))) {
            $lieuxRepository->remove($lieux, true);
        }

        return $this->redirectToRoute('app_lieux_index', [], Response::HTTP_SEE_OTHER);
    }
}

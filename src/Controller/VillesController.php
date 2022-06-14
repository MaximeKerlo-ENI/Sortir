<?php

namespace App\Controller;

use App\Entity\Villes;
use App\Form\VillesType;
use App\Repository\VillesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/villes")
 */
class VillesController extends AbstractController
{
    /**
     * @Route("/", name="app_villes_index", methods={"GET"})
     */
    public function index(VillesRepository $villesRepository): Response
    {
        return $this->render('villes/index.html.twig', [
            'villes' => $villesRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="app_villes_new", methods={"GET", "POST"})
     */
    public function new(Request $request, VillesRepository $villesRepository): Response
    {
        $ville = new Villes();
        $form = $this->createForm(VillesType::class, $ville);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $villesRepository->add($ville, true);

            return $this->redirectToRoute('app_villes_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('villes/new.html.twig', [
            'ville' => $ville,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{noVille}", name="app_villes_show", methods={"GET"})
     */
    public function show(Villes $ville): Response
    {
        return $this->render('villes/show.html.twig', [
            'ville' => $ville,
        ]);
    }

    /**
     * @Route("/{noVille}/edit", name="app_villes_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Villes $ville, VillesRepository $villesRepository): Response
    {
        $form = $this->createForm(VillesType::class, $ville);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $villesRepository->add($ville, true);

            return $this->redirectToRoute('app_villes_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('villes/edit.html.twig', [
            'ville' => $ville,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{noVille}", name="app_villes_delete", methods={"POST"})
     */
    public function delete(Request $request, Villes $ville, VillesRepository $villesRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$ville->getNoVille(), $request->request->get('_token'))) {
            $villesRepository->remove($ville, true);
        }

        return $this->redirectToRoute('app_villes_index', [], Response::HTTP_SEE_OTHER);
    }
}

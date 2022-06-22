<?php
namespace App\Controller;

use App\Repository\LieuxRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

use Symfony\Component\Serializer\SerializerInterface;
class ApiController extends AbstractController
{
    /**
     * @Route("/api/{id}", name="app_api", methods={"GET","POST"})
     */
    public function index(LieuxRepository $lieuRepository, NormalizerInterface $normalizer, SerializerInterface $serializer, $id): Response
    {
        $lieux = $lieuRepository->findByVillesNoVille($id);
        $response = $this->json($lieux, 200, [], ['groups' => 'api']);
        return $response;
    }
}
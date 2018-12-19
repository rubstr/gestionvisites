<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\MedicamentRepository;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Mapping\Factory\ClassMetadataFactory;
// For annotations
use Doctrine\Common\Annotations\AnnotationReader;
use Symfony\Component\Serializer\Mapping\Loader\AnnotationLoader;

class ApiMedicamentController extends AbstractController
{
    /**
     * @Route("/api", name="api")
     */
    public function index()
    {
        return $this->render('api/index.html.twig', [
            'controller_name' => 'ApiController',
        ]);
    }

    /**
     * Retourne une liste de medicaments au format JSON
     * 
     * @Rest\Get("api/medicaments")
     *
     * @param MedicamentRepository $repo
     * @return array
     */
    public function showMedicaments(MedicamentRepository $repo)
    {
        $medicaments = $repo->findAll();

        $classMetadataFactory = new ClassMetadataFactory(new AnnotationLoader(new AnnotationReader()));
        $normalizer = new ObjectNormalizer($classMetadataFactory);
        $serializer = new Serializer(array($normalizer));

        $data = $serializer->normalize($medicaments, null, array('groups' => 'group1'));

        return new JsonResponse($data);
    }
}

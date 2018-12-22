<?php

namespace App\Controller\Api;

use App\Repository\MedicamentRepository;
use FOS\RestBundle\Controller\Annotations\View;
use FOS\RestBundle\Request\ParamFetcherInterface;
use Symfony\Component\Routing\Annotation\Route;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
// use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Medicament;
use App\RepresentationApi\Representation;

class MedicamentController extends FOSRestController
{
    /**
     * Retourne une liste de medicaments au format JSON
     * 
     * @Rest\Get("api/medicaments")
     * @Rest\QueryParam(
     *     name="limit",
     *     requirements="\d+",
     *     default="4",
     *     description="Max number of movies per page."
     * )
     * @Rest\QueryParam(
     *     name="offset",
     *     requirements="\d+",
     *     default="1",
     *     description="The pagination offset"
     * )
     * @View(
     *      serializerGroups= {"group1"}
     * )
     * 
     * @param MedicamentRepository $repo
     * @return array
     */
    public function showMedicaments(MedicamentRepository $repo, ParamFetcherInterface $paramFetcher)
    {
        $pager = $repo->search(
            $paramFetcher->get('limit'),
            $paramFetcher->get('offset')
        );
        // $medicaments = $repo->findAll();
        // return new Representation($pager);
        return $pager;
        // return $medicaments;
    }

    /**
     * Creer un nouveau medicament
     *
     * @Rest\Post("/api/create/medicament")
     * @ParamConverter("medicament", class="App\Entity\Medicament", converter="fos_rest.request_body")
     * @View(StatusCode = 201)
     * 
     * @return void
     */
    public function createMedicament($medicament, ObjectManager $manager)
    {
        $manager->persist($medicament);
        $manager->flush();

        return $medicament;
    }
}

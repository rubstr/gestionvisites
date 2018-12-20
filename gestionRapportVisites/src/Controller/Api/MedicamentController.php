<?php

namespace App\Controller\Api;

use App\Repository\MedicamentRepository;
use FOS\RestBundle\Controller\Annotations\View;
use Symfony\Component\Routing\Annotation\Route;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
// use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Medicament;

class MedicamentController extends FOSRestController
{
    /**
     * Retourne une liste de medicaments au format JSON
     * 
     * @Rest\Get("api/medicaments")
     * @View(
     *      serializerGroups= {"group1"}
     * )
     * 
     * @param MedicamentRepository $repo
     * @return array
     */
    public function showMedicaments(MedicamentRepository $repo)
    {
        $medicaments = $repo->findAll();

        return $medicaments;
    }

    /**
     * Creer un nouveau medicament
     *
     * @Rest\Post("/api/create/medicament")
     * @ParamConverter("medicament", class="App\Entity\Medicament", converter="fos_rest.request_body")
     * @View
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

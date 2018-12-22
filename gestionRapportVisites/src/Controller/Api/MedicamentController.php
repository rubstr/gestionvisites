<?php

namespace App\Controller\Api;

use App\Entity\Medicament;
use App\Repository\MedicamentRepository;
use App\RepresentationApi\Representation;
// use Symfony\Component\Routing\Annotation\Route;
use App\Exception\ResourceValidationException;
use Doctrine\Common\Persistence\ObjectManager;
// use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\Annotations\View;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Request\ParamFetcherInterface;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\Validator\ConstraintViolation;
use Symfony\Component\Validator\ConstraintViolationList;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

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
     * @View()
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
        return new Representation($pager);
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
    public function createMedicament($medicament, ObjectManager $manager, ConstraintViolationList $violations)
    {
        if (count($violations)) {
            $message = 'The JSON sent contains invalid data. Here are the errors you need to correct: ';
            foreach ($violations as $violation) {
                $message .= sprintf("Field %s: %s ", $violation->getPropertyPath(), $violation->getMessage());
            }

            throw new ResourceValidationException($message);
        }
        $manager->persist($medicament);
        $manager->flush();

        return $medicament;
    }
}

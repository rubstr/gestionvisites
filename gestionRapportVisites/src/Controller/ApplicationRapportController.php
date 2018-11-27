<?php

namespace App\Controller;

use App\Entity\RapportVisite;
use App\Form\RapportVisiteType;
use App\Repository\RapportVisiteRepository;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ApplicationRapportController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index()
    {
        return $this->render('application_rapport/index.html.twig', [
            'controller_name' => 'ApplicationRapportController',
        ]);
    }

    /**
     * @Route("/liste_rapport", name="listerapport")
     */
    public function Rapports(RapportVisiteRepository $repo){

        return $this->render('application_rapport/listerapport.html.twig', [
            'controller_name' => "SiteController",
            'rapports' => $repo->findAll()
        ]);

    }

    /**
     * @Route("/create", name="ajoutrapport")
     * @route("/{id}/edit",  name="modifrapport")
     */
    public function form(RapportVisite $rapport=null, Request $request, ObjectManager $manager){
        if (!$rapport) {
            $rapport = new RapportVisite();
        }
        $form = $this->createForm(RapportVisiteType::class, $rapport);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $manager->persist($rapport);
            $manager->flush();

            return $this->redirectToRoute('listerapport');
        }

        return $this->render('application_rapport/create.html.twig',[
            'formRapportVisite' => $form->createView(),
            'editMode' => $rapport->getId()!== null
        ]);
    }


}

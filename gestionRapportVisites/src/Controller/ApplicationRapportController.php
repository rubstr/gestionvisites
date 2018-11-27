<?php

namespace App\Controller;

use App\Repository\RapportVisiteRepository;
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


}

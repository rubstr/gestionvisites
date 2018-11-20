<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

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
}

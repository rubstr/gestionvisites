<?php

namespace App\Controller;

use App\Entity\Medicament;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class PraticienController extends AbstractController
{
    /**
     * @Route("/praticien", name="praticien")
     */
    public function index()
    {
        return $this->render('praticien/index.html.twig', [
            'controller_name' => 'PraticienController',
        ]);
    }
}

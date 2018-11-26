<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

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

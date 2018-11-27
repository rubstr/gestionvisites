<?php

namespace App\Controller;

use App\Entity\Praticien;
use App\Entity\Medicament;
use App\Form\PraticienType;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
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
    /**
     * @Route("/praticien/new", name="praticien_create")
     */
        public function form(Praticien $praticien = null, Request $request, ObjectManager $manager) {
        
            if(!$praticien) {
                $praticien = new Praticien();
            }
            
            $form =$this->createForm(PraticienType::class,$praticien);
    
            $form->handleRequest($request);
                $manager->persist($praticien);
                $manager->flush();
    
                return $this->redirectToRoute('praticien', ['id' => $praticien->getId()]);            
    }
}
<?php

namespace App\Controller;

use App\Entity\Praticien;
use App\Form\PraticienType;
use App\Repository\PraticienRepository;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class PraticienController extends AbstractController
{
    /**
     * @Route("/praticien", name="praticien")
     */
    public function index(PraticienRepository $repo)
    {
        return $this->render('praticien/index.html.twig', [
            'controller_name' => 'PraticienController',
            'praticiens' => $repo->findAll(),
        ]);
    }
    /**
     * @Route("/praticien/new", name="praticien_create")
     * @Route("/praticien/{id}/modifier", name="praticien_modif")
     */
    public function form(Praticien $praticien = null, $ajout=false, ObjectManager $manager, Request $request)
    {
        if(!$praticien)
        {
            $praticien = new Praticien();
            $ajout = true;  //Si = true, le contact est ajouté et non modifié
        }

        $form = $this->createForm(PraticienType::class, $praticien); //Création du form

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $manager->persist($praticien);
            $manager->flush();

           
            return $this->redirectToRoute('praticien');
        }

        return $this->render('praticien/newpraticien.html.twig', [
            'formPraticien' => $form->createView(),
            'ajout' => $ajout
        ]);         
    }
    /**
     * @Route("/praticien/{id}/supprimer", name="praticien_suppr")
     */
    public function remove(PraticienRepository $repo, $id, ObjectManager $manager)
    {
        $praticien = $repo->find($id);
        dump($praticien);
        $manager->remove($praticien);
        $manager->flush();

        return $this->redirectToRoute('praticien');
    }
}

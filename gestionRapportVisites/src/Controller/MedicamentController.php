<?php

namespace App\Controller;

use App\Entity\Medicament;
use App\Form\MedicamentType;
use App\Repository\MedicamentRepository;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class MedicamentController extends AbstractController
{
    /**
     * @Route("/medicament", name="medicament")
     */
    public function index(MedicamentRepository $repo)
    {
        return $this->render('medicament/index.html.twig', [
            'controller_name' => 'MedicamentController',
            'medicaments' => $repo->findAll(),
        ]);
    }

    /**
     * @Route("/medicament/ajouter", name="ajouterMedicament")
     */
    public function form(Medicament $medicament = null, ObjectManager $manager, Request $request)
    {
        if(!$medicament)
        {
            $medicament = new Medicament();
        }

        $form = $this->createForm(MedicamentType::class, $medicament); //Création du form

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $medicament->setDateAjout(new \DateTime());
            $manager->persist($medicament);
            $manager->flush();

           
            return $this->redirectToRoute('medicament');
        }

        return $this->render('medicament/formMedicament.html.twig', [
            'formMedicament' => $form->createView(),
        ]);
    }



}

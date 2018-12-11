<?php

namespace App\Controller;

use App\Entity\Medicament;
use App\Form\MedicamentType;
use App\Entity\PropertySearch;
use App\Form\PropertySearchType;
use App\Repository\MedicamentRepository;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class MedicamentController extends AbstractController
{
    /**
     * @Route("/medicament", name="medicament")
     */
    public function index(MedicamentRepository $repo, Request $request)
    {
        $search = new PropertySearch();
        $form = $this->createForm(PropertySearchType::class, $search);
            
        $form->handleRequest($request);
       
        // dump($form->getData());
        if ($form->isSubmitted() && $form->isValid()) {
            // $data = $form->getData();
            $medocs=$repo->findCritere($search->getSearch(), $search->getDateSearch());
            // $medocs=$repo->findManyByText($search->getSearch());
            dump($medocs);
            return $this->render('medicament/index.html.twig', [
                'medicaments' =>  $medocs,
                'searchForm' => $form->createView(),
            ]);
        }
        
        return $this->render('medicament/index.html.twig', [
            'controller_name' => 'MedicamentController',
            'medicaments' => $repo->findAll(),
            'searchForm' => $form->createView(),     
        ]);
    }

    /**
     * @Route("/medicament/ajouter", name="ajouterMedicament")
     * @Route("/medicament/{id}/modifier", name="modifierMedicament")
     */
    public function form(Medicament $medicament = null, $ajout=false, ObjectManager $manager, Request $request)
    {
        if(!$medicament)
        {
            $medicament = new Medicament();
            $ajout = true;  //Si = true, le contact est ajouté et non modifié
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
            'ajout' => $ajout
        ]);
    }

    /**
     * @Route("/medicament/{id}/supprimer", name="supprimerMedicament")
     */
    public function remove(MedicamentRepository $repo, $id, ObjectManager $manager)
    {
        $medicament = $repo->find($id);
        $manager->remove($medicament);
        $manager->flush();

        return $this->redirectToRoute('medicament');
    }


}

<?php

namespace App\Controller;

use \App\Entity\Inviter;
use App\Entity\Visiteur;
use App\Entity\Praticien;
use App\Form\InviterType;
use App\Entity\ActiviteCompl;
use App\Form\ActiviteComplType;
use App\Repository\InviterRepository;
use App\Repository\VisiteurRepository;
use App\Repository\ActiviteComplRepository;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ActvtComplController extends AbstractController
{
    /**
     * @Route("/activite-complementaire", name="actvt_compl")
     */
    public function index(Request $request, ActiviteComplRepository $repo)
    {
        $form = $this->CreateFormBuilder()
        ->add('search', TextType::class, [
            'attr' => [
                'class' => 'input is-hovered',
                'placeholder' => 'Rechercher'
            ],
            'label' => false,
            'required' => false
        ])
        ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();

            return $this->render('actvt_compl/index.html.twig', [
                'activites' =>  $repo->findManyByText($data['search']),
                'searchForm' => $form->CreateView(),
            ]);
        }
        return $this->render('actvt_compl/index.html.twig', [
            'activites' => $repo->findAll(),
            'searchForm' => $form->CreateView()
        ]);
        
    }

    /**
     * @Route("/activite-complementaire/{id}", name="showActivite")
     */
    public function show(ActiviteComplRepository $repo, $id)
    {
        $activite = $repo->findBy(['id' => $id])[0];
        return $this->render('actvt_compl/showActivite.html.twig', [
            'activite' => $activite,
            'visiteurs' => $activite->getVisiteur(),
            'invitation' => $activite->getInviters()

        ]);
    }

    /**
     * @Route("/inviter-praticien/{id}", name="inviterPraticien")
     */
    public function inviterPraticien(Request $request, ObjectManager $manager, $id, ActiviteComplRepository $repo)
    {
        $inviter = new Inviter();

        $form = $this->CreateForm(InviterType::class, $inviter);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $inviter->setActiviteCompl($repo->find($id));
            $manager->persist($inviter);
            $manager->flush();

            return $this->redirectToRoute('showActivite',[ "id" => $id]);
        }

        return $this->render('actvt_compl/Invitationform.html.twig', [
            'form' => $form->CreateView()
        ]);
    }

    /**
     * @Route("/supprimer-invitation/{id}", name="removeInviter")
     */
    public function removeInviter($id, ObjectManager $manager, InviterRepository $repo)
    {
        $invitation = $repo->find($id);
        $manager->remove($invitation);
        $manager->flush();

        return $this->redirectToRoute("showActivite", [ "id" => $invitation->getActiviteCompl()->getId()]);
    }

    /**
     * @Route("/ajouter-organisateur/{id}", name="ajouterVisiteur")
     */
    public function ajouterOrganisateur(ObjectManager $manager, Request $request, $id, ActiviteComplRepository $repo)
    {
        $activite = $repo->find($id);

        
        $form = $this->CreateFormBuilder()
                     ->add('visiteur', EntityType::class, [
                         'class' => Visiteur::class,
                     ])->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $visiteur = $form->getData()['visiteur'];
            $activite->addVisiteur($visiteur);
            $manager->persist($activite);
            $manager->flush();

            return $this->redirectToRoute("showActivite", [ "id" => $activite->getId()]);
        }

        return $this->render('actvt_compl/VisiteurForm.html.twig', [
            'form' => $form->CreateView(),
        ]);
    }

    /**
     * @Route("/activite-complementaire/{idActivite}/supprimer-organisateur/{idOrganisateur}", name="removeOrganisateur")
     */
    public function removeOrganisateur($idActivite, $idOrganisateur,ObjectManager $manager, VisiteurRepository $repoVisiteur, Request $request, ActiviteComplRepository $repoActivite)
    {
        $visiteur = $repoVisiteur->find($idOrganisateur);
        $activite = $repoActivite->find($idActivite);
        $activite->removeVisiteur($visiteur);
        $manager->persist($activite);
        $manager->flush();

        return $this->redirect($request->headers->get('referer'));
    }

    /**
     * @Route("/modifier-activite-complementaire/{id}", name="modifierActivite")
     * @Route("/ajouter-activite-complementaire/", name="ajouterActivite")
     */
    public function formEvenement(ActiviteCompl $activite = null, $ajout=false, ObjectManager $manager, Request $request)
    {
        if(!$activite)
        {
            $activite = new ActiviteCompl();
            $ajout = true;  //Si = true, le contact est ajouté et non modifié
        }

        $form = $this->createForm(ActiviteComplType::class, $activite); //Création du form

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $manager->persist($activite);
            $manager->flush();

           
            return $this->redirectToRoute('actvt_compl');
        }

        return $this->render('actvt_compl/ActiviteForm.html.twig', [
            'form' => $form->CreateView(),
            'ajout' => $ajout
        ]);
    }

    /**
     * @Route("/supprimer-activite-complementaire/{id}", name="supprimerActivite")
     */
    public function removeActivite($id, ActiviteComplRepository $repo, ObjectManager $manager)
    {
        $manager->remove($repo->find($id));
        $manager->flush();

        return $this->redirectToRoute('actvt_compl');
    }
}

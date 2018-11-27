<?php

namespace App\Controller;

use App\Repository\ActiviteComplRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ActvtComplController extends AbstractController
{
    /**
     * @Route("/activite-complementaire", name="actvt_compl")
     */
    public function index(Request $request, ActiviteComplRepository $repo)
    {
        $form = $this->createFormBuilder(array('message' => 'search'))
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
                'searchForm' => $form->createView(),
            ]);
        }
        dump($repo->findAll());
        return $this->render('actvt_compl/index.html.twig', [
            'activites' => $repo->findAll(),
            'searchForm' => $form->createView()
        ]);
        
    }

    /**
     * @Route("/activite-complementaire/{id}", name="showActivite")
     */
    public function show(ActiviteComplRepository $repo, $id)
    {
        dump($repo->findBy(['id' => $id]));
        return $this->render('actvt_compl/showActivite.html.twig', [
            'activite' => $repo->findBy(['id' => $id])[0],
        ]);
    }
}

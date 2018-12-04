<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use App\Repository\UserRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Request;

class SecurityController extends AbstractController
{
    /**
     * @Route("/login", name="login")
     */
    public function index(AuthenticationUtils $authUtils)
    {
        $error = $authUtils->getLastAuthenticationError();
        $lastUsername = $authUtils->getLastUsername();
        return $this->render(
            'security/login.html.twig',
            array(
                'last_username' => $lastUsername,
                'error' => $error
            )
        );
    }
    /**
     * @Route("/logout", name="logout")
     */
    public function logout()
    {
        
    }
  /**
     * @Route("/changecouleur/{id}/{couleur}", name="changecl")
     */
    public function changecl($id,$couleur, UserRepository $repo, ObjectManager $manager, Request $request)
    {
        $user = $repo->find($id);
        $user->setCouleur($couleur);
       
        $manager->persist($user);
        $manager->flush();
       dump($request);
        return $this->redirect($request->headers->get("referer"));
    }
}

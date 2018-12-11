<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 */
class User implements UserInterface
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * Identifiant / login
     * 
     * @var string
     * @ORM\Column(type="string", length=255)
     */
    private $identifiant;

    /**
     * Mot de passe
     * 
     * @var string
     * @ORM\Column(type="string", length=255)
     */
    private $password;

    /**
     * Role de l'utilisateur
     * 
     * @var array
     * @ORM\Column(type="simple_array")
     */
    private $roles = ['ROLE_VISITEUR'];

     /**
     * Couleur du theme choisi
     * 
     * @var string 
     * @ORM\Column(type="string", length=255)
     */
    private $couleur = "is-info";

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdentifiant(): ?string
    {
        return $this->identifiant;
    }

    public function setIdentifiant(string $identifiant): self
    {
        $this->identifiant = $identifiant;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getRoles(): ?array
    {
        return $this->roles;
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    public function getCouleur(): ?string
    {
        return $this->couleur;
    }

    public function setCouleur(string $couleur): self
    {
        $this->couleur = $couleur;

        return $this;
    }
    // public function serialize()
    // {
    //     return serialize(array(
    //         $this->id,
    //         $this->identifiant,
    //         $this->password,
    //     ));
    // }
    // public function unserialize($serialized)
    // {
    //     list (
    //         $this->id,
    //         $this->identifiant,
    //         $this->password,
    //     ) = unserialize($serialized);
        
    // }
    public function getSalt()
    {

    }
    public function getUsername()
    {
        return $this->identifiant;
    }
    
    
    public function eraseCredentials()
    {

    }
}

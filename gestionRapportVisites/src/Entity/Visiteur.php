<?php

namespace App\Entity;

use App\Entity\Visiteur;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity(repositoryClass="App\Repository\VisiteurRepository")
 */
class Visiteur
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var string
     * @ORM\Column(type="string", length=255)
     */
    private $vis_nom;

    /**
     * @var string
     * @ORM\Column(type="string", length=255)
     */
    private $vis_prenom;

    /**
     * Rapport rédigé
     * 
     * @var collection|rapportVisite[]
     * @ORM\OneToMany(targetEntity="App\Entity\RapportVisite", mappedBy="visiteur")
     */
    private $rapportVisites;

    /**
     * Acitivite(s) que le visiteur a organise
     * 
     * @var collection|activiteCompl[]
     * @ORM\ManyToMany(targetEntity="App\Entity\ActiviteCompl", mappedBy="visiteur")
     */
    private $activiteCompls;

    public function __construct()
    {
        $this->rapportVisites = new ArrayCollection();
        $this->activiteCompls = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getVisNom(): ?string
    {
        return $this->vis_nom;
    }

    public function setVisNom(string $vis_nom): self
    {
        $this->vis_nom = $vis_nom;

        return $this;
    }

    public function getVisPrenom(): ?string
    {
        return $this->vis_prenom;
    }

    public function setVisPrenom(string $vis_prenom): self
    {
        $this->vis_prenom = $vis_prenom;

        return $this;
    }

    /**
     * @return Collection|RapportVisite[]
     */
    public function getRapportVisites(): Collection
    {
        return $this->rapportVisites;
    }

    public function addRapportVisite(RapportVisite $rapportVisite): self
    {
        if (!$this->rapportVisites->contains($rapportVisite)) {
            $this->rapportVisites[] = $rapportVisite;
            $rapportVisite->setVisiteur($this);
        }

        return $this;
    }

    public function removeRapportVisite(RapportVisite $rapportVisite): self
    {
        if ($this->rapportVisites->contains($rapportVisite)) {
            $this->rapportVisites->removeElement($rapportVisite);
            // set the owning side to null (unless already changed)
            if ($rapportVisite->getVisiteur() === $this) {
                $rapportVisite->setVisiteur(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|ActiviteCompl[]
     */
    public function getActiviteCompls(): Collection
    {
        return $this->activiteCompls;
    }

    public function addActiviteCompl(ActiviteCompl $activiteCompl): self
    {
        if (!$this->activiteCompls->contains($activiteCompl)) {
            $this->activiteCompls[] = $activiteCompl;
            $activiteCompl->addVisiteur($this);
        }

        return $this;
    }

    public function removeActiviteCompl(ActiviteCompl $activiteCompl): self
    {
        if ($this->activiteCompls->contains($activiteCompl)) {
            $this->activiteCompls->removeElement($activiteCompl);
            $activiteCompl->removeVisiteur($this);
        }

        return $this;
    }

    public function __toString()
    {
        return $this->vis_nom . " " . $this->vis_prenom;
    }
}

<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PraticienRepository")
 */
class Praticien
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $pra_nom;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $pra_prenom;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\RapportVisite", mappedBy="praticien")
     */
    private $rapportVisites;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Inviter", mappedBy="praticien")
     */
    private $inviters;

    public function __construct()
    {
        $this->rapportVisites = new ArrayCollection();
        $this->inviters = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPraNom(): ?string
    {
        return $this->pra_nom;
    }

    public function setPraNom(string $pra_nom): self
    {
        $this->pra_nom = $pra_nom;

        return $this;
    }

    public function getPraPrenom(): ?string
    {
        return $this->pra_prenom;
    }

    public function setPraPrenom(string $pra_prenom): self
    {
        $this->pra_prenom = $pra_prenom;

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
            $rapportVisite->setPraticien($this);
        }

        return $this;
    }

    public function removeRapportVisite(RapportVisite $rapportVisite): self
    {
        if ($this->rapportVisites->contains($rapportVisite)) {
            $this->rapportVisites->removeElement($rapportVisite);
            // set the owning side to null (unless already changed)
            if ($rapportVisite->getPraticien() === $this) {
                $rapportVisite->setPraticien(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Inviter[]
     */
    public function getInviters(): Collection
    {
        return $this->inviters;
    }

    public function addInviter(Inviter $inviter): self
    {
        if (!$this->inviters->contains($inviter)) {
            $this->inviters[] = $inviter;
            $inviter->setPraticien($this);
        }

        return $this;
    }

    public function removeInviter(Inviter $inviter): self
    {
        if ($this->inviters->contains($inviter)) {
            $this->inviters->removeElement($inviter);
            // set the owning side to null (unless already changed)
            if ($inviter->getPraticien() === $this) {
                $inviter->setPraticien(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
        return $this->pra_nom . ' ' . $this->pra_prenom;
    }
}

<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\RapportVisiteRepository")
 */
class RapportVisite
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="date")
     */
    private $rap_date;

    /**
     * @ORM\Column(type="text")
     */
    private $rap_bilan;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $rap_motif;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Visiteur", inversedBy="rapportVisites")
     * @ORM\JoinColumn(nullable=false)
     */
    private $visiteur;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Praticien", inversedBy="rapportVisites")
     * @ORM\JoinColumn(nullable=false)
     */
    private $praticien;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Offrir", mappedBy="rapportVisite", orphanRemoval=true)
     */
    private $offrirs;

    public function __construct()
    {
        $this->offrirs = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRapDate(): ?\DateTimeInterface
    {
        return $this->rap_date;
    }

    public function setRapDate(\DateTimeInterface $rap_date): self
    {
        $this->rap_date = $rap_date;

        return $this;
    }

    public function getRapbilan(): ?string
    {
        return $this->rap_bilan;
    }

    public function setRapbilan(string $rap_bilan): self
    {
        $this->rap_bilan = $rap_bilan;

        return $this;
    }

    public function getRapMotif(): ?string
    {
        return $this->rap_motif;
    }

    public function setRapMotif(string $rap_motif): self
    {
        $this->rap_motif = $rap_motif;

        return $this;
    }

    public function getVisiteur(): ?Visiteur
    {
        return $this->visiteur;
    }

    public function setVisiteur(?Visiteur $visiteur): self
    {
        $this->visiteur = $visiteur;

        return $this;
    }

    public function getPraticien(): ?Praticien
    {
        return $this->praticien;
    }

    public function setPraticien(?Praticien $praticien): self
    {
        $this->praticien = $praticien;

        return $this;
    }

    /**
     * @return Collection|Offrir[]
     */
    public function getOffrirs(): Collection
    {
        return $this->offrirs;
    }

    public function addOffrir(Offrir $offrir): self
    {
        if (!$this->offrirs->contains($offrir)) {
            $this->offrirs[] = $offrir;
            $offrir->setRapportVisite($this);
        }

        return $this;
    }

    public function removeOffrir(Offrir $offrir): self
    {
        if ($this->offrirs->contains($offrir)) {
            $this->offrirs->removeElement($offrir);
            // set the owning side to null (unless already changed)
            if ($offrir->getRapportVisite() === $this) {
                $offrir->setRapportVisite(null);
            }
        }

        return $this;
    }
}

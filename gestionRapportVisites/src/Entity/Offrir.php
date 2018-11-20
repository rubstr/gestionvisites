<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\OffrirRepository")
 */
class Offrir
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $off_qte;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\RapportVisite", inversedBy="offrirs")
     * @ORM\JoinColumn(nullable=false)
     */
    private $rapportVisite;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Medicament", inversedBy="offrirs")
     * @ORM\JoinColumn(nullable=false)
     */
    private $medicament;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getOffQte(): ?int
    {
        return $this->off_qte;
    }

    public function setOffQte(int $off_qte): self
    {
        $this->off_qte = $off_qte;

        return $this;
    }

    public function getRapportVisite(): ?RapportVisite
    {
        return $this->rapportVisite;
    }

    public function setRapportVisite(?RapportVisite $rapportVisite): self
    {
        $this->rapportVisite = $rapportVisite;

        return $this;
    }

    public function getMedicament(): ?Medicament
    {
        return $this->medicament;
    }

    public function setMedicament(?Medicament $medicament): self
    {
        $this->medicament = $medicament;

        return $this;
    }
}

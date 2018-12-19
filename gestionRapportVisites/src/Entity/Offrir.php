<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * Reference un medicament et sa quantite offerte a un praticien lors d'une visite
 * 
 * @ORM\Entity(repositoryClass="App\Repository\OffrirRepository")
 * @ORM\Table(uniqueConstraints={
 *       @ORM\UniqueConstraint(name="medicament_offert_unique", columns={"rapport_visite_id","medicament_id"})
 *       })
 */
class Offrir
{
    /**
     * @Groups({"group1"})
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * Quantite de medicament offert
     * 
     * @Groups({"group1"})
     * @var int
     * @ORM\Column(type="integer")
     */
    private $off_qte;

    /**
     * Compte-rendu de la visite
     * 
     * @Groups({"group1"})
     * @var rapportVisite
     * @ORM\ManyToOne(targetEntity="App\Entity\RapportVisite", inversedBy="offrirs")
     * @ORM\JoinColumn(nullable=false)
     */
    private $rapportVisite;

    /**
     * @var medicament
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

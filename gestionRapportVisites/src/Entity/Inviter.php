<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\InviterRepository")
 * @ORM\Table(uniqueConstraints={
 *       @ORM\UniqueConstraint(name="praticien_invitation_unique", columns={"activite_compl_id","praticien_id"})
 *       })
 */
class Inviter
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
    private $specialisation;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\ActiviteCompl", inversedBy="inviters")
     * @ORM\JoinColumn(nullable=false)
     */
    private $activiteCompl;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Praticien", inversedBy="inviters")
     * @ORM\JoinColumn(nullable=false)
     */
    private $praticien;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSpecialisation(): ?string
    {
        return $this->specialisation;
    }

    public function setSpecialisation(string $specialisation): self
    {
        $this->specialisation = $specialisation;

        return $this;
    }

    public function getActiviteCompl(): ?ActiviteCompl
    {
        return $this->activiteCompl;
    }

    public function setActiviteCompl(?ActiviteCompl $activiteCompl): self
    {
        $this->activiteCompl = $activiteCompl;

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
}

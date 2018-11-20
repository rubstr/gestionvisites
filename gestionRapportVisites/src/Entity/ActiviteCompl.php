<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ActiviteComplRepository")
 */
class ActiviteCompl
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
    private $date;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $lieu;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $theme;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Visiteur", inversedBy="activiteCompls")
     */
    private $visiteur;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Inviter", mappedBy="activiteCompl", orphanRemoval=true)
     */
    private $inviters;

    public function __construct()
    {
        $this->visiteur = new ArrayCollection();
        $this->inviters = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getLieu(): ?string
    {
        return $this->lieu;
    }

    public function setLieu(string $lieu): self
    {
        $this->lieu = $lieu;

        return $this;
    }

    public function getTheme(): ?string
    {
        return $this->theme;
    }

    public function setTheme(string $theme): self
    {
        $this->theme = $theme;

        return $this;
    }

    /**
     * @return Collection|Visiteur[]
     */
    public function getVisiteur(): Collection
    {
        return $this->visiteur;
    }

    public function addVisiteur(Visiteur $visiteur): self
    {
        if (!$this->visiteur->contains($visiteur)) {
            $this->visiteur[] = $visiteur;
        }

        return $this;
    }

    public function removeVisiteur(Visiteur $visiteur): self
    {
        if ($this->visiteur->contains($visiteur)) {
            $this->visiteur->removeElement($visiteur);
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
            $inviter->setActiviteCompl($this);
        }

        return $this;
    }

    public function removeInviter(Inviter $inviter): self
    {
        if ($this->inviters->contains($inviter)) {
            $this->inviters->removeElement($inviter);
            // set the owning side to null (unless already changed)
            if ($inviter->getActiviteCompl() === $this) {
                $inviter->setActiviteCompl(null);
            }
        }

        return $this;
    }
}

<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ReserveRepository")
 */
class Reserve
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Trajet", inversedBy="reserves")
     */
    private $idTrajet;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\User", inversedBy="reserves")
     */
    private $idUtilisateur;

    public function __construct()
    {
        $this->idTrajet = new ArrayCollection();
        $this->idUtilisateur = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection|Trajet[]
     */
    public function getIdTrajet(): Collection
    {
        return $this->idTrajet;
    }

    public function addIdTrajet(Trajet $idTrajet): self
    {
        if (!$this->idTrajet->contains($idTrajet)) {
            $this->idTrajet[] = $idTrajet;
        }

        return $this;
    }

    public function removeIdTrajet(Trajet $idTrajet): self
    {
        if ($this->idTrajet->contains($idTrajet)) {
            $this->idTrajet->removeElement($idTrajet);
        }

        return $this;
    }

    /**
     * @return Collection|User[]
     */
    public function getIdUtilisateur(): Collection
    {
        return $this->idUtilisateur;
    }

    public function addIdUtilisateur(User $idUtilisateur): self
    {
        if (!$this->idUtilisateur->contains($idUtilisateur)) {
            $this->idUtilisateur[] = $idUtilisateur;
        }

        return $this;
    }

    public function removeIdUtilisateur(User $idUtilisateur): self
    {
        if ($this->idUtilisateur->contains($idUtilisateur)) {
            $this->idUtilisateur->removeElement($idUtilisateur);
        }

        return $this;
    }
}

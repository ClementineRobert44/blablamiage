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
     * @ORM\Column(type="datetime")
     */
    private $dateReservation;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Passager", mappedBy="reserve")
     */
    private $idPassager;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Trajet", mappedBy="reserve")
     */
    private $idTrajet;

    public function __construct()
    {
        $this->idPassager = new ArrayCollection();
        $this->idTrajet = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateReservation(): ?\DateTimeInterface
    {
        return $this->dateReservation;
    }

    public function setDateReservation(\DateTimeInterface $dateReservation): self
    {
        $this->dateReservation = $dateReservation;

        return $this;
    }

    /**
     * @return Collection|Passager[]
     */
    public function getIdPassager(): Collection
    {
        return $this->idPassager;
    }

    public function addIdPassager(Passager $idPassager): self
    {
        if (!$this->idPassager->contains($idPassager)) {
            $this->idPassager[] = $idPassager;
            $idPassager->setReserve($this);
        }

        return $this;
    }

    public function removeIdPassager(Passager $idPassager): self
    {
        if ($this->idPassager->contains($idPassager)) {
            $this->idPassager->removeElement($idPassager);
            // set the owning side to null (unless already changed)
            if ($idPassager->getReserve() === $this) {
                $idPassager->setReserve(null);
            }
        }

        return $this;
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
            $idTrajet->setReserve($this);
        }

        return $this;
    }

    public function removeIdTrajet(Trajet $idTrajet): self
    {
        if ($this->idTrajet->contains($idTrajet)) {
            $this->idTrajet->removeElement($idTrajet);
            // set the owning side to null (unless already changed)
            if ($idTrajet->getReserve() === $this) {
                $idTrajet->setReserve(null);
            }
        }

        return $this;
    }
}

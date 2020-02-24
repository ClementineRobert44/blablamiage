<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CommentaireRepository")
 */
class Commentaire
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
    private $dateCom;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $contenuCom;

    /**
     * @ORM\Column(type="integer")
     */
    private $note;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Conducteur", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $idConducteur;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Trajet", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $idTrajet;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Passager", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $idPassager;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateCom(): ?\DateTimeInterface
    {
        return $this->dateCom;
    }

    public function setDateCom(\DateTimeInterface $dateCom): self
    {
        $this->dateCom = $dateCom;

        return $this;
    }

    public function getContenuCom(): ?string
    {
        return $this->contenuCom;
    }

    public function setContenuCom(string $contenuCom): self
    {
        $this->contenuCom = $contenuCom;

        return $this;
    }

    public function getNote(): ?int
    {
        return $this->note;
    }

    public function setNote(int $note): self
    {
        $this->note = $note;

        return $this;
    }

    public function getIdConducteur(): ?Conducteur
    {
        return $this->idConducteur;
    }

    public function setIdConducteur(Conducteur $idConducteur): self
    {
        $this->idConducteur = $idConducteur;

        return $this;
    }

    public function getIdTrajet(): ?Trajet
    {
        return $this->idTrajet;
    }

    public function setIdTrajet(Trajet $idTrajet): self
    {
        $this->idTrajet = $idTrajet;

        return $this;
    }

    public function getIdPassager(): ?Passager
    {
        return $this->idPassager;
    }

    public function setIdPassager(Passager $idPassager): self
    {
        $this->idPassager = $idPassager;

        return $this;
    }

    
}

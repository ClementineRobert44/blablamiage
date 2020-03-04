<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\VoitureRepository")
 */
class Voiture
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $marqueVoiture;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $modeleVoiture;

    /**
     * @ORM\Column(type="date")
     */
    private $anneeVoiture;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $couleurVoiture;

    /**
     * @ORM\Column(type="integer")
     */
    private $nbPlacesVoiture;

    /**
     * @ORM\Column(type="string", length=25)
     */
    private $tailleBagages;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\User", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $idUtilisateur;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMarqueVoiture(): ?string
    {
        return $this->marqueVoiture;
    }

    public function setMarqueVoiture(string $marqueVoiture): self
    {
        $this->marqueVoiture = $marqueVoiture;

        return $this;
    }

    public function getModeleVoiture(): ?string
    {
        return $this->modeleVoiture;
    }

    public function setModeleVoiture(string $modeleVoiture): self
    {
        $this->modeleVoiture = $modeleVoiture;

        return $this;
    }

    public function getAnneeVoiture(): ?\DateTimeInterface
    {
        return $this->anneeVoiture;
    }

    public function setAnneeVoiture(\DateTimeInterface $anneeVoiture): self
    {
        $this->anneeVoiture = $anneeVoiture;

        return $this;
    }

    public function getCouleurVoiture(): ?string
    {
        return $this->couleurVoiture;
    }

    public function setCouleurVoiture(string $couleurVoiture): self
    {
        $this->couleurVoiture = $couleurVoiture;

        return $this;
    }

    public function getNbPlacesVoiture(): ?int
    {
        return $this->nbPlacesVoiture;
    }

    public function setNbPlacesVoiture(int $nbPlacesVoiture): self
    {
        $this->nbPlacesVoiture = $nbPlacesVoiture;

        return $this;
    }

    public function getTailleBagages(): ?string
    {
        return $this->tailleBagages;
    }

    public function setTailleBagages(string $tailleBagages): self
    {
        $this->tailleBagages = $tailleBagages;

        return $this;
    }

    public function getIdUtilisateur(): ?User
    {
        return $this->idUtilisateur;
    }

    public function setIdUtilisateur(User $idUtilisateur): self
    {
        $this->idUtilisateur = $idUtilisateur;

        return $this;
    }

    
}

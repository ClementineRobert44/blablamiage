<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 * @ORM\Table(name="Commentaire")
 * @ORM\HasLifecycleCallbacks() 
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
     * @ORM\OneToOne(targetEntity="App\Entity\User", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $idUtilisateur;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Trajet", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $idTrajet;

    /**
     * @ORM\Column(type="integer")
     */
    private $idUtilisateurCommente;

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

    /**
    * @ORM\PrePersist()
    */
    public function prePersist()
    {
    $this->dateCom = new \DateTime();
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

    public function getIdUtilisateur(): ?User
    {
        return $this->idUtilisateur;
    }

    public function setIdConducteur(User $idUtilisateur): self
    {
        $this->idUtilisateur = $idUtilisateur;

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

    public function getIdUtilisateurCommente(): ?int
    {
        return $this->idUtilisateurCommente;
    }

    public function setIdUtilisateurCommente(int $idUtilisateurCommente): self
    {
        $this->idUtilisateurCommente = $idUtilisateurCommente;

        return $this;
    }

    

    
}

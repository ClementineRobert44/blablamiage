<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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
     * @ORM\OneToOne(targetEntity="App\Entity\Trajet", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $idTrajet;

    

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\User", inversedBy="commentairesRecus")
     * @ORM\JoinTable(name="reçois_commentaire")
     */
    private $idUtilisateurCommente;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\User", inversedBy="commentairesPostes")
     * @ORM\JoinTable(name="poste_commentaire")
     */
    private $idUtilisateurQuiCommente;

    public function __construct()
    {
        
        $this->idUtilisateurCommente = new ArrayCollection();
        $this->idUtilisateurQuiCommente = new ArrayCollection();
    }

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

    

    public function getIdTrajet(): ?Trajet
    {
        return $this->idTrajet;
    }

    public function setIdTrajet(Trajet $idTrajet): self
    {
        $this->idTrajet = $idTrajet;

        return $this;
    }

    

    /**
     * @return Collection|User[]
     */
    public function getIdUtilisateurCommente(): Collection
    {
        return $this->idUtilisateurCommente;
    }

    public function addIdUtilisateurCommente(User $idUtilisateurCommente): self
    {
        if (!$this->idUtilisateurCommente->contains($idUtilisateurCommente)) {
            $this->idUtilisateurCommente[] = $idUtilisateurCommente;
        }

        return $this;
    }

    public function removeIdUtilisateurCommente(User $idUtilisateurCommente): self
    {
        if ($this->idUtilisateurCommente->contains($idUtilisateurCommente)) {
            $this->idUtilisateurCommente->removeElement($idUtilisateurCommente);
        }

        return $this;
    }

    /**
     * @return Collection|User[]
     */
    public function getIdUtilisateurQuiCommente(): Collection
    {
        return $this->idUtilisateurQuiCommente;
    }

    public function addIdUtilisateurQuiCommente(User $idUtilisateurQuiCommente): self
    {
        if (!$this->idUtilisateurQuiCommente->contains($idUtilisateurQuiCommente)) {
            $this->idUtilisateurQuiCommente[] = $idUtilisateurQuiCommente;
        }

        return $this;
    }

    public function removeIdUtilisateurQuiCommente(User $idUtilisateurQuiCommente): self
    {
        if ($this->idUtilisateurQuiCommente->contains($idUtilisateurQuiCommente)) {
            $this->idUtilisateurQuiCommente->removeElement($idUtilisateurQuiCommente);
        }

        return $this;
    }

    
    

    
}

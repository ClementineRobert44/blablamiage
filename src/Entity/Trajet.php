<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;


/**
 * @ORM\Entity(repositoryClass="App\Repository\TrajetRepository")
 * @ORM\Table(name="Trajet")
 * @ORM\HasLifecycleCallbacks()
 */
class Trajet
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="time")
     */
    private $heureDepart;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $adresseDepart;

    /**
     * @ORM\Column(type="integer")
     */
    private $codePostalDepart;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $villeDepart;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $adresseArrivee;

    /**
     * @ORM\Column(type="integer")
     */
    private $codePostalArrivee;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $villeArrivee;

    /**
     * @ORM\Column(type="integer")
     */
    private $nbPassagers;

    /**
     * @ORM\Column(type="float")
     */
    private $prixTrajet;

    /**
     * @ORM\Column(type="datetime")
     */
    private $datePublication;
    

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Reserve", mappedBy="idTrajet")
     */
    private $reserves;

    

    /**
     * @ORM\Column(type="date")
     */
    private $dateDepart;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\User", inversedBy="trajets")
     */
    private $idUtilisateur;

    

    

    public function __construct()
    {
        $this->reserves = new ArrayCollection();
        $this->idUtilisateur = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getHeureDepart(): ?\DateTimeInterface
    {
        return $this->heureDepart;
    }

    public function setHeureDepart(\DateTimeInterface $heureDepart): self
    {
        $this->heureDepart = $heureDepart;

        return $this;
    }

    public function getAdresseDepart(): ?string
    {
        return $this->adresseDepart;
    }

    public function setAdresseDepart(string $adresseDepart): self
    {
        $this->adresseDepart = $adresseDepart;

        return $this;
    }

    public function getCodePostalDepart(): ?int
    {
        return $this->codePostalDepart;
    }

    public function setCodePostalDepart(int $codePostalDepart): self
    {
        $this->codePostalDepart = $codePostalDepart;

        return $this;
    }

    public function getVilleDepart(): ?string
    {
        return $this->villeDepart;
    }

    public function setVilleDepart(string $villeDepart): self
    {
        $this->villeDepart = $villeDepart;

        return $this;
    }

    public function getAdresseArrivee(): ?string
    {
        return $this->adresseArrivee;
    }

    public function setAdresseArrivee(string $adresseArrivee): self
    {
        $this->adresseArrivee = $adresseArrivee;

        return $this;
    }

    public function getCodePostalArrivee(): ?int
    {
        return $this->codePostalArrivee;
    }

    public function setCodePostalArrivee(int $codePostalArrivee): self
    {
        $this->codePostalArrivee = $codePostalArrivee;

        return $this;
    }

    public function getVilleArrivee(): ?string
    {
        return $this->villeArrivee;
    }

    public function setVilleArrivee(string $villeArrivee): self
    {
        $this->villeArrivee = $villeArrivee;

        return $this;
    }

    public function getNbPassagers(): ?int
    {
        return $this->nbPassagers;
    }

    public function setNbPassagers(int $nbPassagers): self
    {
        $this->nbPassagers = $nbPassagers;

        return $this;
    }

    public function getPrixTrajet(): ?float
    {
        return $this->prixTrajet;
    }

    public function setPrixTrajet(float $prixTrajet): self
    {
        $this->prixTrajet = $prixTrajet;

        return $this;
    }

    public function getDatePublication(): ?\DateTimeInterface
    {
        return $this->datePublication;
    }

    public function setDatePublication(\DateTimeInterface $datePublication): self
    {
        $this->datePublication = $datePublication;

        return $this;
    }

    /**
     * @ORM\PrePersist()
     */
    public function prePersist()
    {
        $this->datePublication = new \DateTime();
    }

    

    /**
     * @return Collection|Reserve[]
     */
    public function getReserves(): Collection
    {
        return $this->reserves;
    }

    public function addReserf(Reserve $reserf): self
    {
        if (!$this->reserves->contains($reserf)) {
            $this->reserves[] = $reserf;
            $reserf->addIdTrajet($this);
        }

        return $this;
    }

    public function removeReserf(Reserve $reserf): self
    {
        if ($this->reserves->contains($reserf)) {
            $this->reserves->removeElement($reserf);
            $reserf->removeIdTrajet($this);
        }

        return $this;
    }

   

    /**
    * toString
    * @return string
    */
   public function __toString()
   {
           return $this->getVilleArrivee();
   }

   public function getDateDepart(): ?\DateTimeInterface
   {
       return $this->dateDepart;
   }

   public function setDateDepart(\DateTimeInterface $dateDepart): self
   {
       $this->dateDepart = $dateDepart;

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

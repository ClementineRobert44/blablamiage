<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\UserInterface;
use Gedmo\Mapping\Annotation as Gedmo;


/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 * @UniqueEntity(fields={"email"}, message="There is already an account with this email")
 */
class User implements UserInterface
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     */
    private $email;

    /**
     * @ORM\Column(type="json")
     */
    private $roles = [];

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $prenom;

    /**
     * @ORM\Column(type="date")
     */
    private $dateNaissance;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $bio;

    /**
     * @ORM\Column(type="integer")
     */
    private $tel;

    /**
     * @ORM\Column(type="string", length=5)
     */
    private $animaux;

    /**
     * @ORM\Column(type="string", length=5)
     */
    private $cigarette;

    /**
     * @var string
     * @Gedmo\Slug(fields={"nom"})
     * @ORM\Column(type="string", length=128, unique=true)
     */
    private $slug;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Trajet", mappedBy="idUtilisateur")
     */
    private $trajets;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Trajet", mappedBy="idUser")
     */
    private $trajetsReserves;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Commentaire", mappedBy="idUtilisateurCommente")
     */
    private $commentairesRecus;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Commentaire", mappedBy="idUtilisateurQuiCommente")
     */
    private $commentairesPostes;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Voiture", mappedBy="idUtilisateur", cascade={"persist", "remove"})
     */
    private $voiture;

    /**
     * @ORM\Column(type="string", length=7)
     */
    private $sexe;

    /**
     * @ORM\Column(type="string", length=25)
     */
    private $theme;

    

    public function __construct()
    {
        $this->trajets = new ArrayCollection();
        $this->trajetsReserves = new ArrayCollection();
        $this->commentairesRecus = new ArrayCollection();
        $this->commentairesPostes = new ArrayCollection();
    }



    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUsername(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getPassword(): string
    {
        return (string) $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getSalt()
    {
        // not needed when using the "bcrypt" algorithm in security.yaml
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getDateNaissance(): ?\DateTimeInterface
    {
        return $this->dateNaissance;
    }

    public function setDateNaissance(\DateTimeInterface $dateNaissance): self
    {
        $this->dateNaissance = $dateNaissance;

        return $this;
    }

    public function getBio(): ?string
    {
        return $this->bio;
    }

    public function setBio(string $bio): self
    {
        $this->bio = $bio;

        return $this;
    }

    public function getTel(): ?int
    {
        return $this->tel;
    }

    public function setTel(int $tel): self
    {
        $this->tel = $tel;

        return $this;
    }

    public function getAnimaux(): ?string
    {
        return $this->animaux;
    }

    public function setAnimaux(string $animaux): self
    {
        $this->animaux = $animaux;

        return $this;
    }

    public function getCigarette(): ?string
    {
        return $this->cigarette;
    }

    public function setCigarette(string $cigarette): self
    {
        $this->cigarette = $cigarette;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getSlug(): ?string
    {
        return $this->slug;
    }

    /**
     * @param string $slug
     */
    public function setSlug(string $slug): void
    {
        $this->slug = $slug;
    }

    

    /**
    * toString
    * @return string
    */
   public function __toString()
   {
           return $this->getNom();
   }

   /**
    * @return Collection|Trajet[]
    */
   public function getTrajets(): Collection
   {
       return $this->trajets;
   }

   public function addTrajet(Trajet $trajet): self
   {
       if (!$this->trajets->contains($trajet)) {
           $this->trajets[] = $trajet;
           $trajet->addIdUtilisateur($this);
       }

       return $this;
   }

   public function removeTrajet(Trajet $trajet): self
   {
       if ($this->trajets->contains($trajet)) {
           $this->trajets->removeElement($trajet);
           $trajet->removeIdUtilisateur($this);
       }

       return $this;
   }

   /**
    * @return Collection|Trajet[]
    */
   public function getTrajetsReserves(): Collection
   {
       return $this->trajetsReserves;
   }

   public function addTrajetsReserf(Trajet $trajetsReserf): self
   {
       if (!$this->trajetsReserves->contains($trajetsReserf)) {
           $this->trajetsReserves[] = $trajetsReserf;
           $trajetsReserf->addIdUser($this);
       }

       return $this;
   }

   public function removeTrajetsReserf(Trajet $trajetsReserf): self
   {
       if ($this->trajetsReserves->contains($trajetsReserf)) {
           $this->trajetsReserves->removeElement($trajetsReserf);
           $trajetsReserf->removeIdUser($this);
       }

       return $this;
   }

   /**
    * @return Collection|Commentaire[]
    */
   public function getCommentairesRecus(): Collection
   {
       return $this->commentairesRecus;
   }

   public function addCommentairesRecus(Commentaire $commentairesRecus): self
   {
       if (!$this->commentairesRecus->contains($commentairesRecus)) {
           $this->commentairesRecus[] = $commentairesRecus;
           $commentairesRecus->addIdUtilisateurCommente($this);
       }

       return $this;
   }

   public function removeCommentairesRecus(Commentaire $commentairesRecus): self
   {
       if ($this->commentairesRecus->contains($commentairesRecus)) {
           $this->commentairesRecus->removeElement($commentairesRecus);
           $commentairesRecus->removeIdUtilisateurCommente($this);
       }

       return $this;
   }

   /**
    * @return Collection|Commentaire[]
    */
   public function getCommentairesPostes(): Collection
   {
       return $this->commentairesPostes;
   }

   public function addCommentairesPoste(Commentaire $commentairesPoste): self
   {
       if (!$this->commentairesPostes->contains($commentairesPoste)) {
           $this->commentairesPostes[] = $commentairesPoste;
           $commentairesPoste->addIdUtilisateurQuiCommente($this);
       }

       return $this;
   }

   public function removeCommentairesPoste(Commentaire $commentairesPoste): self
   {
       if ($this->commentairesPostes->contains($commentairesPoste)) {
           $this->commentairesPostes->removeElement($commentairesPoste);
           $commentairesPoste->removeIdUtilisateurQuiCommente($this);
       }

       return $this;
   }

   public function getVoiture(): ?Voiture
   {
       return $this->voiture;
   }

   public function setVoiture(Voiture $voiture): self
   {
       $this->voiture = $voiture;

       // set the owning side of the relation if necessary
       if ($voiture->getIdUtilisateur() !== $this) {
           $voiture->setIdUtilisateur($this);
       }

       return $this;
   }

   public function getSexe(): ?string
   {
       return $this->sexe;
   }

   public function setSexe(string $sexe): self
   {
       $this->sexe = $sexe;

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

   
}

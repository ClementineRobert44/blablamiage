<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UtilisateurRepository")
 */
class Utilisateur
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
     * @ORM\Column(type="string", length=150)
     */
    private $mail;

    /**
     * @ORM\Column(type="string", length=500)
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
     * @ORM\ManyToMany(targetEntity="App\Entity\Reserve", mappedBy="idUtilisateur")
     */
    private $reserves;

    /**
     * @var string
     * @Gedmo\Slug(fields={"nom"})
     * @ORM\Column(type="string", length=128, unique=true)
     */
    private $slug;

    public function __construct()
    {
        $this->reserves = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getMail(): ?string
    {
        return $this->mail;
    }

    public function setMail(string $mail): self
    {
        $this->mail = $mail;

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
            $reserf->addIdUtilisateur($this);
        }

        return $this;
    }

    public function removeReserf(Reserve $reserf): self
    {
        if ($this->reserves->contains($reserf)) {
            $this->reserves->removeElement($reserf);
            $reserf->removeIdUtilisateur($this);
        }

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
}

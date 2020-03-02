<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ConducteurRepository")
 */
class Conducteur
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
    private $nomConducteur;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $prenomConducteur;

    /**
     * @ORM\Column(type="date")
     */
    private $dateNaissanceConducteur;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $mailConducteur;

    /**
     * @ORM\Column(type="string", length=300)
     */
    private $bioConducteur;

    /**
     * @ORM\Column(type="integer")
     */
    private $telConducteur;

    /**
     * @ORM\Column(type="string", length=10)
     */
    private $animaux;

    /**
     * @ORM\Column(type="string", length=10)
     */
    private $cigarette;

    /**
     * @ORM\Column(type="string", length=25)
     */
    private $mdpConducteur;

    /**
     * @var string
     * @Gedmo\Slug(fields={"nomConducteur"})
     * @ORM\Column(type="string", length=128, unique=true)
     */
    private $slug;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomConducteur(): ?string
    {
        return $this->nomConducteur;
    }

    public function setNomConducteur(string $nomConducteur): self
    {
        $this->nomConducteur = $nomConducteur;

        return $this;
    }

    public function getPrenomConducteur(): ?string
    {
        return $this->prenomConducteur;
    }

    public function setPrenomConducteur(string $prenomConducteur): self
    {
        $this->prenomConducteur = $prenomConducteur;

        return $this;
    }

    public function getDateNaissanceConducteur(): ?\DateTimeInterface
    {
        return $this->dateNaissanceConducteur;
    }

    public function setDateNaissanceConducteur(\DateTimeInterface $dateNaissanceConducteur): self
    {
        $this->dateNaissanceConducteur = $dateNaissanceConducteur;

        return $this;
    }

    public function getMailConducteur(): ?string
    {
        return $this->mailConducteur;
    }

    public function setMailConducteur(string $mailConducteur): self
    {
        $this->mailConducteur = $mailConducteur;

        return $this;
    }

    public function getBioConducteur(): ?string
    {
        return $this->bioConducteur;
    }

    public function setBioConducteur(string $bioConducteur): self
    {
        $this->bioConducteur = $bioConducteur;

        return $this;
    }

    public function getTelConducteur(): ?int
    {
        return $this->telConducteur;
    }

    public function setTelConducteur(int $telConducteur): self
    {
        $this->telConducteur = $telConducteur;

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

    public function getMdpConducteur(): ?string
    {
        return $this->mdpConducteur;
    }

    public function setMdpConducteur(string $mdpConducteur): self
    {
        $this->mdpConducteur = $mdpConducteur;

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

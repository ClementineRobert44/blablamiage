<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PassagerRepository")
 */
class Passager
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
    private $nomPassager;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $prenomPassager;

    /**
     * @ORM\Column(type="date")
     */
    private $dateNaissancePassager;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $mailPassager;

    /**
     * @ORM\Column(type="string", length=300)
     */
    private $bioPassager;

    /**
     * @ORM\Column(type="integer")
     */
    private $telPassager;

    /**
     * @ORM\Column(type="string", length=10)
     */
    private $animaux;

    /**
     * @ORM\Column(type="string", length=10)
     */
    private $cigarette;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomPassager(): ?string
    {
        return $this->nomPassager;
    }

    public function setNomPassager(string $nomPassager): self
    {
        $this->nomPassager = $nomPassager;

        return $this;
    }

    public function getPrenomPassager(): ?string
    {
        return $this->prenomPassager;
    }

    public function setPrenomPassager(string $prenomPassager): self
    {
        $this->prenomPassager = $prenomPassager;

        return $this;
    }

    public function getDateNaissancePassager(): ?\DateTimeInterface
    {
        return $this->dateNaissancePassager;
    }

    public function setDateNaissancePassager(\DateTimeInterface $dateNaissancePassager): self
    {
        $this->dateNaissancePassager = $dateNaissancePassager;

        return $this;
    }

    public function getMailPassager(): ?string
    {
        return $this->mailPassager;
    }

    public function setMailPassager(string $mailPassager): self
    {
        $this->mailPassager = $mailPassager;

        return $this;
    }

    public function getBioPassager(): ?string
    {
        return $this->bioPassager;
    }

    public function setBioPassager(string $bioPassager): self
    {
        $this->bioPassager = $bioPassager;

        return $this;
    }

    public function getTelPassager(): ?int
    {
        return $this->telPassager;
    }

    public function setTelPassager(int $telPassager): self
    {
        $this->telPassager = $telPassager;

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
}

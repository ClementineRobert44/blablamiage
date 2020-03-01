<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

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

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Reserve", inversedBy="idPassager")
     */
    private $reserve;

    /**
     * @ORM\Column(type="string", length=25)
     */
    private $mdpPassager;

    /**
     * @var string
     * @Gedmo\Slug(fields={"nomPassager"})
     * @ORM\Column(type="string", length=128, unique=true)
     */
    private $slug;

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

    public function getReserve(): ?Reserve
    {
        return $this->reserve;
    }

    public function setReserve(?Reserve $reserve): self
    {
        $this->reserve = $reserve;

        return $this;
    }

    public function getMdpPassager(): ?string
    {
        return $this->mdpPassager;
    }

    public function setMdpPassager(string $mdpPassager): self
    {
        $this->mdpPassager = $mdpPassager;

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

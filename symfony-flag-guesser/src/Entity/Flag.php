<?php

namespace App\Entity;

use App\Repository\FlagRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass=FlagRepository::class)
 * @UniqueEntity("ISO")
 */
class Flag
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=10)
     */
    private $ISO;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $nom_fr;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $nom_en;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $category;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getISO(): ?string
    {
        return $this->ISO;
    }

    public function setISO(string $ISO): self
    {
        $this->ISO = $ISO;

        return $this;
    }

    public function getNomFr(): ?string
    {
        return $this->nom_fr;
    }

    public function setNomFr(string $nom_fr): self
    {
        $this->nom_fr = $nom_fr;

        return $this;
    }

    public function getNomEn(): ?string
    {
        return $this->nom_en;
    }

    public function setNomEn(string $nom_en): self
    {
        $this->nom_en = $nom_en;

        return $this;
    }

    public function getCategory(): ?string
    {
        return $this->category;
    }

    public function setCategory(string $category): self
    {
        $this->category = $category;

        return $this;
    }
}

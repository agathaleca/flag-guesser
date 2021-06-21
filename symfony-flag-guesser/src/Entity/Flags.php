<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Flags
 *
 * @ORM\Table(name="flags")
 * @ORM\Entity(repositoryClass="App\Repository\FlagsRepository")
 */
class Flags
{
    /**
     * @var string
     *
     * @ORM\Column(name="ISO", type="string", length=10, nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $iso;

    /**
     * @var string
     *
     * @ORM\Column(name="nom_fr", type="string", length=50, nullable=false)
     */
    private $nomFr;

    /**
     * @var string
     *
     * @ORM\Column(name="nom_en", type="string", length=50, nullable=false)
     */
    private $nomEn;

    /**
     * @var string
     *
     * @ORM\Column(name="Category", type="string", length=50, nullable=false)
     */
    private $category;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Games", mappedBy="iso")
     */
    private $idGame;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->idGame = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function getIso(): ?string
    {
        return $this->iso;
    }

    public function getNomFr(): ?string
    {
        return $this->nomFr;
    }

    public function setNomFr(string $nomFr): self
    {
        $this->nomFr = $nomFr;

        return $this;
    }

    public function getNomEn(): ?string
    {
        return $this->nomEn;
    }

    public function setNomEn(string $nomEn): self
    {
        $this->nomEn = $nomEn;

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

    /**
     * @return Collection|Games[]
     */
    public function getIdGame(): Collection
    {
        return $this->idGame;
    }

    public function addIdGame(Games $idGame): self
    {
        if (!$this->idGame->contains($idGame)) {
            $this->idGame[] = $idGame;
            $idGame->addIso($this);
        }

        return $this;
    }

    public function removeIdGame(Games $idGame): self
    {
        if ($this->idGame->removeElement($idGame)) {
            $idGame->removeIso($this);
        }

        return $this;
    }

}

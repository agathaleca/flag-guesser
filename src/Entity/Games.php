<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Games
 *
 * @ORM\Table(name="games", indexes={@ORM\Index(name="Games_Users_FK", columns={"played_by"})})
 * @ORM\Entity(repositoryClass="App\Repository\GamesRepository")
 */
class Games
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_game", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idGame;

    /**
     * @var string
     *
     * @ORM\Column(name="category", type="string", length=50, nullable=false)
     */
    private $category;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="played_on", type="datetime", nullable=true)
     */
    private $playedOn;

    /**
     * @var \Users
     *
     * @ORM\ManyToOne(targetEntity="Users")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="played_by", referencedColumnName="id_user")
     * })
     */
    private $playedBy;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Flags", inversedBy="idGame")
     * @ORM\JoinTable(name="is_in_quiz",
     *   joinColumns={
     *     @ORM\JoinColumn(name="id_game", referencedColumnName="id_game")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="ISO", referencedColumnName="ISO")
     *   }
     * )
     */
    private $iso;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->iso = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function getIdGame(): ?int
    {
        return $this->idGame;
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

    public function getPlayedOn(): ?\DateTimeInterface
    {
        return $this->playedOn;
    }

    public function setPlayedOn(?\DateTimeInterface $playedOn): self
    {
        $this->playedOn = $playedOn;

        return $this;
    }

    public function getPlayedBy(): ?Users
    {
        return $this->playedBy;
    }

    public function setPlayedBy(?Users $playedBy): self
    {
        $this->playedBy = $playedBy;

        return $this;
    }

    /**
     * @return Collection|Flags[]
     */
    public function getIso(): Collection
    {
        return $this->iso;
    }

    public function addIso(Flags $iso): self
    {
        if (!$this->iso->contains($iso)) {
            $this->iso[] = $iso;
        }

        return $this;
    }

    public function removeIso(Flags $iso): self
    {
        $this->iso->removeElement($iso);

        return $this;
    }

}

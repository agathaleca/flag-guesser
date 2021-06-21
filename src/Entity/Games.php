<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Games
 *
 * @ORM\Table(name="games")
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
     * @ORM\Column(name="catgory", type="string", length=50, nullable=false)
     */
    private $catgory;

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
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Users", inversedBy="idGame")
     * @ORM\JoinTable(name="plays",
     *   joinColumns={
     *     @ORM\JoinColumn(name="id_game", referencedColumnName="id_game")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="id", referencedColumnName="id")
     *   }
     * )
     */
    private $id;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Answers", mappedBy="idGame")
     */
    private $idAnswer;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->iso = new \Doctrine\Common\Collections\ArrayCollection();
        $this->id = new \Doctrine\Common\Collections\ArrayCollection();
        $this->idAnswer = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function getIdGame(): ?int
    {
        return $this->idGame;
    }

    public function getCatgory(): ?string
    {
        return $this->catgory;
    }

    public function setCatgory(string $catgory): self
    {
        $this->catgory = $catgory;

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

    /**
     * @return Collection|Users[]
     */
    public function getId(): Collection
    {
        return $this->id;
    }

    public function addId(Users $id): self
    {
        if (!$this->id->contains($id)) {
            $this->id[] = $id;
        }

        return $this;
    }

    public function removeId(Users $id): self
    {
        $this->id->removeElement($id);

        return $this;
    }

    /**
     * @return Collection|Answers[]
     */
    public function getIdAnswer(): Collection
    {
        return $this->idAnswer;
    }

    public function addIdAnswer(Answers $idAnswer): self
    {
        if (!$this->idAnswer->contains($idAnswer)) {
            $this->idAnswer[] = $idAnswer;
            $idAnswer->addIdGame($this);
        }

        return $this;
    }

    public function removeIdAnswer(Answers $idAnswer): self
    {
        if ($this->idAnswer->removeElement($idAnswer)) {
            $idAnswer->removeIdGame($this);
        }

        return $this;
    }

}

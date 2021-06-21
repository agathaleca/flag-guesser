<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Answers
 *
 * @ORM\Table(name="answers")
 * @ORM\Entity(repositoryClass="App\Repository\AnswersRepository")
 */
class Answers
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_answer", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idAnswer;

    /**
     * @var string
     *
     * @ORM\Column(name="answer", type="string", length=50, nullable=false)
     */
    private $answer;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Games", inversedBy="idAnswer")
     * @ORM\JoinTable(name="to_the_quiz",
     *   joinColumns={
     *     @ORM\JoinColumn(name="id_answer", referencedColumnName="id_answer")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="id_game", referencedColumnName="id_game")
     *   }
     * )
     */
    private $idGame;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->idGame = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function getIdAnswer(): ?int
    {
        return $this->idAnswer;
    }

    public function getAnswer(): ?string
    {
        return $this->answer;
    }

    public function setAnswer(string $answer): self
    {
        $this->answer = $answer;

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
        }

        return $this;
    }

    public function removeIdGame(Games $idGame): self
    {
        $this->idGame->removeElement($idGame);

        return $this;
    }

}

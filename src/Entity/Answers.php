<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Answers
 *
 * @ORM\Table(name="answers", indexes={@ORM\Index(name="Answers_Games_FK", columns={"id_game"})})
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
     * @var int
     *
     * @ORM\Column(name="score_answer", type="integer", nullable=false)
     */
    private $scoreAnswer;

    /**
     * @var \Games
     *
     * @ORM\ManyToOne(targetEntity="Games")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_game", referencedColumnName="id_game")
     * })
     */
    private $idGame;

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

    public function getScoreAnswer(): ?int
    {
        return $this->scoreAnswer;
    }

    public function setScoreAnswer(int $scoreAnswer): self
    {
        $this->scoreAnswer = $scoreAnswer;

        return $this;
    }
    
    public function getIdGame(): ?int
    {
        return $this->idGame->idGame;
    }

    public function setIdGame(?Games $idGame): self
    {
        $this->idGame = $idGame;

        return $this;
    }

}

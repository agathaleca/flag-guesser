<?php

namespace App\Entity;

use App\Repository\QuestionRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=QuestionRepository::class)
 */
class Question
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="smallint")
     */
    private $asked;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $time_asked;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $time_answered;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $player_answer;

    /**
     * @ORM\ManyToOne(targetEntity=Flag::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $flag;

    /**
     * @ORM\ManyToOne(targetEntity=Game::class, inversedBy="questions")
     * @ORM\JoinColumn(nullable=false)
     */
    private $quiz;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAsked(): ?int
    {
        return $this->asked;
    }

    public function setAsked(int $asked): self
    {
        $this->asked = $asked;

        return $this;
    }

    public function getTimeAsked(): ?\DateTimeInterface
    {
        return $this->time_asked;
    }

    public function setTimeAsked(?\DateTimeInterface $time_asked): self
    {
        $this->time_asked = $time_asked;

        return $this;
    }

    public function getTimeAnswered(): ?\DateTimeInterface
    {
        return $this->time_answered;
    }

    public function setTimeAnswered(?\DateTimeInterface $time_answered): self
    {
        $this->time_answered = $time_answered;

        return $this;
    }

    public function getPlayerAnswer(): ?string
    {
        return $this->player_answer;
    }

    public function setPlayerAnswer(?string $player_answer): self
    {
        $this->player_answer = $player_answer;

        return $this;
    }

    public function getFlag(): ?Flag
    {
        return $this->flag;
    }

    public function setFlag(?Flag $flag): self
    {
        $this->flag = $flag;

        return $this;
    }

    public function getQuiz(): ?Game
    {
        return $this->quiz;
    }

    public function setQuiz(?Game $quiz): self
    {
        $this->quiz = $quiz;

        return $this;
    }
}

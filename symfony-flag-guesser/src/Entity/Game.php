<?php

namespace App\Entity;

use App\Repository\GameRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\Question;

/**
 * @ORM\Entity(repositoryClass=GameRepository::class)
 */
class Game
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $category;


    /**
     * @ORM\Column(type="datetime")
     */
    private $played_on;

    /**
     * @ORM\Column(type="integer")
     */
    private $game_score;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="games", cascade={"persist"})
     */
    private $played_by;

    /**
     * @ORM\OneToMany(targetEntity=Question::class, mappedBy="quiz", orphanRemoval=true, cascade={"persist"})
     */
    private $questions;

    public function __construct()
    {
        $this->questions = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getGameScore(): ?int
    {
        return $this->game_score;
    }

    public function setGameScore(int $game_score): self
    {
        $this->game_score = $game_score;

        return $this;
    }

    public function getPlayedOn(): ?\DateTimeInterface
    {
        return $this->played_on;
    }

    public function setPlayedOn(\DateTimeInterface $played_on): self
    {
        $this->played_on = $played_on;

        return $this;
    }

    public function getPlayedBy(): ?User
    {
        return $this->played_by;
    }

    public function setPlayedBy(?User $played_by): self
    {
        $this->played_by = $played_by;

        return $this;
    }


    /**
     * @return Collection|Question[]
     */
    public function getQuestions(): Collection
    {
        return $this->questions;
    }

    public function addQuestion(Question $question): self
    {
        if (!$this->questions->contains($question)) {
            $this->questions[] = $question;
            $question->setQuiz($this);
        }

        return $this;
    }

    public function removeQuestion(Question $question): self
    {
        if ($this->questions->removeElement($question)) {
            // set the owning side to null (unless already changed)
            if ($question->getQuiz() === $this) {
                $question->setQuiz(null);
            }
        }

        return $this;
    }

    public function getCurrentQuestion(): ?Question
    {
        $current_question=null;
        $questions_list = $this->getQuestions();
        foreach ($questions_list as $question) {
            if ($question->getAsked()==1) {
                $current_question=$question;
                return $current_question;
            }
        }
        return null;
    }

    public function passToNextQuestion()
    {
        $questions_list = $this->getQuestions();
        foreach ($questions_list as $question) {
            if ($question->getAsked()==0) {
                // la première question à l'état "non posée" passe à "en cours"
                // on rempli ses champs en conséquence 
                $question->setTimeAsked(new \DateTime());
                $question->setAsked(1);
                // on s'arrête dés qu'une question "non posée" est trouvée
                break;
            }
        }
    }

    public function getTotalScore() : int
    {
        $total_score=0;
        for ($i=0;$i<count($this->getQuestions());$i++) {
            $total_score += $this->getQuestions()[$i]->getScore();
        }
        return $total_score;
    }

    public function getMoyTemps(): ?float
    {
        $total_time=0;
        foreach ($this->getQuestions() as $question) {
            $total_time += $question->getTimeAnswered()->diff($question->getTimeAsked())->s;
        }
        return ($total_time/count($this->getQuestions()));
    }

}

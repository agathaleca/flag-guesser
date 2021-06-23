<?php

namespace App\Entity;

use App\Repository\GameRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

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
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="games", cascade={"persist"})
     */
    private $played_by;

    /**
     * @ORM\OneToMany(targetEntity=Question::class, mappedBy="quiz", orphanRemoval=true, cascade={"persist"})
     */
    private $questions;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $score;

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

    public function getScore(): ?int
    {
        return $this->score;
    }

    public function setScore(?int $score): self
    {
        $this->score = $score;

        return $this;
    }
}

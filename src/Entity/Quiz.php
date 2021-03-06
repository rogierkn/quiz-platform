<?php

declare(strict_types=1);

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\QuizRepository")
 */
class Quiz
{
    /**
     * The unique id of the quiz.
     *
     * @var int
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * The name of the quiz.
     *
     * @var string
     * @ORM\Column(type="string")
     * @Assert\Length(min="3", max="100")
     * @Assert\NotBlank()
     */
    private $name;

    /**
     * The questions of the quiz.
     *
     * @var Question[]|Collection
     * @ORM\OneToMany(targetEntity="Question", mappedBy="quiz", cascade={"all"}, fetch="EAGER")
     */
    private $questions;

    /**
     * The sessions of the quiz.
     *
     * @var Session[]|Collection
     * @ORM\OneToMany(targetEntity="Session", mappedBy="quiz", cascade={"all"})
     */
    private $sessions;

    public function __construct()
    {
        $this->questions = new ArrayCollection();
        $this->sessions = new ArrayCollection();
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return Question[]|Collection
     */
    public function getQuestions(): Collection
    {
        return $this->questions;
    }

    /**
     * @param Question $question
     */
    public function addQuestion(Question $question): void
    {
        $this->questions->add($question);
        $question->setQuiz($this);
    }

    /**
     * @param Question $question
     */
    public function removeQuestion(Question $question): void
    {
        $this->questions->removeElement($question);
        $question->setQuiz(null);
    }

    /**
     * @return Session[]|Collection
     */
    public function getSessions(): Collection
    {
        return $this->sessions;
    }

    /**
     * @param Session $session
     */
    public function addSession(Session $session): void
    {
        $this->sessions->add($session);
        $session->setQuiz($this);
    }

    /**
     * @param Session $session
     */
    public function removeSession(Session $session): void
    {
        $this->sessions->removeElement($session);
        $session->setQuiz(null);
    }
}

<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\SceneRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SceneRepository::class)]
#[ApiResource]
class Scene
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'scenes')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Act $act = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $conflict = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $details = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $location = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $time = null;

    /**
     * @var Collection<int, Question>
     */
    #[ORM\OneToMany(mappedBy: 'scene', targetEntity: Question::class)]
    private Collection $questions;

    /**
     * @var Collection<int, Npc>
     */
    #[ORM\ManyToMany(targetEntity: Npc::class, mappedBy: 'scenes')]
    private Collection $npcs;

    /**
     * @var Collection<int, Character>
     */
    #[ORM\ManyToMany(targetEntity: Character::class, inversedBy: 'scenes')]
    private Collection $players;

    public function __construct()
    {
        $this->questions = new ArrayCollection();
        $this->npcs = new ArrayCollection();
        $this->players = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAct(): ?Act
    {
        return $this->act;
    }

    public function setAct(?Act $act): static
    {
        $this->act = $act;

        return $this;
    }

    public function getConflict(): ?string
    {
        return $this->conflict;
    }

    public function setConflict(?string $conflict): static
    {
        $this->conflict = $conflict;

        return $this;
    }

    public function getDetails(): ?string
    {
        return $this->details;
    }

    public function setDetails(?string $details): static
    {
        $this->details = $details;

        return $this;
    }

    public function getLocation(): ?string
    {
        return $this->location;
    }

    public function setLocation(?string $location): static
    {
        $this->location = $location;

        return $this;
    }

    public function getTime(): ?string
    {
        return $this->time;
    }

    public function setTime(?string $time): static
    {
        $this->time = $time;

        return $this;
    }

    /**
     * @return Collection<int, Question>
     */
    public function getQuestions(): Collection
    {
        return $this->questions;
    }

    public function addQuestion(Question $question): static
    {
        if (!$this->questions->contains($question)) {
            $this->questions->add($question);
            $question->setScene($this);
        }

        return $this;
    }

    public function removeQuestion(Question $question): static
    {
        if ($this->questions->removeElement($question)) {
            // set the owning side to null (unless already changed)
            if ($question->getScene() === $this) {
                $question->setScene(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Npc>
     */
    public function getNpcs(): Collection
    {
        return $this->npcs;
    }

    public function addNpc(Npc $npc): static
    {
        if (!$this->npcs->contains($npc)) {
            $this->npcs->add($npc);
            $npc->addScene($this);
        }

        return $this;
    }

    public function removeNpc(Npc $npc): static
    {
        if ($this->npcs->removeElement($npc)) {
            $npc->removeScene($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, Character>
     */
    public function getPlayers(): Collection
    {
        return $this->players;
    }

    public function addPlayer(Character $player): static
    {
        if (!$this->players->contains($player)) {
            $this->players->add($player);
        }

        return $this;
    }

    public function removePlayer(Character $player): static
    {
        $this->players->removeElement($player);

        return $this;
    }
}

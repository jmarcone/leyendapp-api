<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\GameMachineStateRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: GameMachineStateRepository::class)]
#[ApiResource]
class GameMachineState
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    /**
     * @var Collection<int, GameMachine>
     */
    #[ORM\OneToMany(mappedBy: 'gameMachineState', targetEntity: GameMachine::class)]
    private Collection $gameMachine;

    public function __construct()
    {
        $this->gameMachine = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection<int, GameMachine>
     */
    public function getGameMachine(): Collection
    {
        return $this->gameMachine;
    }

    public function addGameMachine(GameMachine $gameMachine): static
    {
        if (!$this->gameMachine->contains($gameMachine)) {
            $this->gameMachine->add($gameMachine);
            $gameMachine->setGameMachineState($this);
        }

        return $this;
    }

    public function removeGameMachine(GameMachine $gameMachine): static
    {
        if ($this->gameMachine->removeElement($gameMachine)) {
            // set the owning side to null (unless already changed)
            if ($gameMachine->getGameMachineState() === $this) {
                $gameMachine->setGameMachineState(null);
            }
        }

        return $this;
    }
}

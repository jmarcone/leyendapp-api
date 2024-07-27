<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\GameMachineRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: GameMachineRepository::class)]
#[ApiResource]
class GameMachine
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $scene = null;

    #[ORM\Column]
    private ?int $act = null;

    #[ORM\Column(length: 255)]
    private ?string $xState = null;

    #[ORM\ManyToOne(inversedBy: 'gameMachine')]
    #[ORM\JoinColumn(nullable: false)]
    private ?GameMachineState $gameMachineState = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getScene(): ?int
    {
        return $this->scene;
    }

    public function setScene(int $scene): static
    {
        $this->scene = $scene;

        return $this;
    }

    public function getAct(): ?int
    {
        return $this->act;
    }

    public function setAct(int $act): static
    {
        $this->act = $act;

        return $this;
    }

    public function getXState(): ?string
    {
        return $this->xState;
    }

    public function setXState(string $xState): static
    {
        $this->xState = $xState;

        return $this;
    }

    public function getGameMachineState(): ?GameMachineState
    {
        return $this->gameMachineState;
    }

    public function setGameMachineState(?GameMachineState $gameMachineState): static
    {
        $this->gameMachineState = $gameMachineState;

        return $this;
    }
}

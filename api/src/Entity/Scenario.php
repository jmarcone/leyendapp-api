<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\ScenarioRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ScenarioRepository::class)]
#[ApiResource]
class Scenario
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    /**
     * @var Collection<int, Game>
     */
    #[ORM\OneToMany(mappedBy: 'scenario', targetEntity: Game::class)]
    private Collection $games;

    /**
     * @var Collection<int, Trasfondo>
     */
    #[ORM\OneToMany(mappedBy: 'scenario', targetEntity: Trasfondo::class)]
    private Collection $trasfondos;

    public function __construct()
    {
        $this->games = new ArrayCollection();
        $this->trasfondos = new ArrayCollection();
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
     * @return Collection<int, Game>
     */
    public function getGames(): Collection
    {
        return $this->games;
    }

    public function addGame(Game $game): static
    {
        if (!$this->games->contains($game)) {
            $this->games->add($game);
            $game->setScenario($this);
        }

        return $this;
    }

    public function removeGame(Game $game): static
    {
        if ($this->games->removeElement($game)) {
            // set the owning side to null (unless already changed)
            if ($game->getScenario() === $this) {
                $game->setScenario(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Trasfondo>
     */
    public function getTrasfondos(): Collection
    {
        return $this->trasfondos;
    }

    public function addTrasfondo(Trasfondo $trasfondo): static
    {
        if (!$this->trasfondos->contains($trasfondo)) {
            $this->trasfondos->add($trasfondo);
            $trasfondo->setScenario($this);
        }

        return $this;
    }

    public function removeTrasfondo(Trasfondo $trasfondo): static
    {
        if ($this->trasfondos->removeElement($trasfondo)) {
            // set the owning side to null (unless already changed)
            if ($trasfondo->getScenario() === $this) {
                $trasfondo->setScenario(null);
            }
        }

        return $this;
    }
}

<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\CharacterRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CharacterRepository::class)]
#[ApiResource]
class Character
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'characters')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Player $player = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $origen = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $rasgoLegendario = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    /**
     * @var Collection<int, Motivacion>
     */
    #[ORM\OneToMany(mappedBy: 'character', targetEntity: Motivacion::class)]
    private Collection $motivacions;

    /**
     * @var Collection<int, Motivacion>
     */
    #[ORM\OneToMany(mappedBy: 'vinculacion', targetEntity: Motivacion::class)]
    private Collection $vinculaciones;

    #[ORM\ManyToOne(inversedBy: 'characters')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Trasfondo $trasfondo = null;

    public function __construct()
    {
        $this->motivacions = new ArrayCollection();
        $this->vinculaciones = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPlayer(): ?Player
    {
        return $this->player;
    }

    public function setPlayer(?Player $player): static
    {
        $this->player = $player;

        return $this;
    }

    public function getOrigen(): ?string
    {
        return $this->origen;
    }

    public function setOrigen(string $origen): static
    {
        $this->origen = $origen;

        return $this;
    }

    public function getRasgoLegendario(): ?string
    {
        return $this->rasgoLegendario;
    }

    public function setRasgoLegendario(string $rasgoLegendario): static
    {
        $this->rasgoLegendario = $rasgoLegendario;

        return $this;
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
     * @return Collection<int, Motivacion>
     */
    public function getMotivacions(): Collection
    {
        return $this->motivacions;
    }

    public function addMotivacion(Motivacion $motivacion): static
    {
        if (!$this->motivacions->contains($motivacion)) {
            $this->motivacions->add($motivacion);
            $motivacion->setCharacter($this);
        }

        return $this;
    }

    public function removeMotivacion(Motivacion $motivacion): static
    {
        if ($this->motivacions->removeElement($motivacion)) {
            // set the owning side to null (unless already changed)
            if ($motivacion->getCharacter() === $this) {
                $motivacion->setCharacter(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Motivacion>
     */
    public function getVinculaciones(): Collection
    {
        return $this->vinculaciones;
    }

    public function addVinculacione(Motivacion $vinculacione): static
    {
        if (!$this->vinculaciones->contains($vinculacione)) {
            $this->vinculaciones->add($vinculacione);
            $vinculacione->setVinculacion($this);
        }

        return $this;
    }

    public function removeVinculacione(Motivacion $vinculacione): static
    {
        if ($this->vinculaciones->removeElement($vinculacione)) {
            // set the owning side to null (unless already changed)
            if ($vinculacione->getVinculacion() === $this) {
                $vinculacione->setVinculacion(null);
            }
        }

        return $this;
    }

    public function getTrasfondo(): ?Trasfondo
    {
        return $this->trasfondo;
    }

    public function setTrasfondo(?Trasfondo $trasfondo): static
    {
        $this->trasfondo = $trasfondo;

        return $this;
    }
}

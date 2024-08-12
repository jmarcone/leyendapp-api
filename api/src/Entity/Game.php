<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiProperty;
use ApiPlatform\Metadata\ApiResource;
use App\Repository\GameRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: GameRepository::class)]
#[ApiResource]
class Game
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    #[Assert\NotBlank]
    #[ApiProperty(iris: ["https://schema.org/name"])]
    private ?string $name = null;

    /**
     * @var Collection<int, Act>
     */
    #[ORM\OneToMany(mappedBy: 'game', targetEntity: Act::class)]
    private Collection $acts;

    /**
     * @var Collection<int, Choir>
     */
    #[ORM\OneToMany(mappedBy: 'game', targetEntity: Choir::class)]
    private Collection $choirs;


    /**
     * @var Collection<int, Npc>
     */
    #[ORM\OneToMany(mappedBy: 'game', targetEntity: Npc::class)]
    private Collection $npcs;

    #[ORM\ManyToOne(inversedBy: 'games')]
    #[ORM\JoinColumn(nullable: true)]
    private ?Scenario $scenario = null;

    #[ORM\ManyToOne(inversedBy: 'gamesDirecting')]
    #[ORM\JoinColumn(nullable: true)]
    private ?Usuario $director = null;

    /**
     * @var Collection<int, Character>
     */
    #[ORM\OneToMany(mappedBy: 'game', targetEntity: Character::class)]
    private Collection $characters;

    public function __construct()
    {
        $this->acts = new ArrayCollection();
        $this->choirs = new ArrayCollection();
        $this->npcs = new ArrayCollection();
        $this->characters = new ArrayCollection();
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
     * @return Collection<int, Act>
     */
    public function getActs(): Collection
    {
        return $this->acts;
    }

    public function addAct(Act $act): static
    {
        if (!$this->acts->contains($act)) {
            $this->acts->add($act);
            $act->setGame($this);
        }

        return $this;
    }

    public function removeAct(Act $act): static
    {
        if ($this->acts->removeElement($act)) {
            // set the owning side to null (unless already changed)
            if ($act->getGame() === $this) {
                $act->setGame(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Choir>
     */
    public function getChoirs(): Collection
    {
        return $this->choirs;
    }

    public function addChoir(Choir $choir): static
    {
        if (!$this->choirs->contains($choir)) {
            $this->choirs->add($choir);
            $choir->setGame($this);
        }

        return $this;
    }

    public function removeChoir(Choir $choir): static
    {
        if ($this->choirs->removeElement($choir)) {
            // set the owning side to null (unless already changed)
            if ($choir->getGame() === $this) {
                $choir->setGame(null);
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
            $npc->setGame($this);
        }

        return $this;
    }

    public function removeNpc(Npc $npc): static
    {
        if ($this->npcs->removeElement($npc)) {
            // set the owning side to null (unless already changed)
            if ($npc->getGame() === $this) {
                $npc->setGame(null);
            }
        }

        return $this;
    }

    public function getScenario(): ?Scenario
    {
        return $this->scenario;
    }

    public function setScenario(?Scenario $scenario): static
    {
        $this->scenario = $scenario;

        return $this;
    }

    public function getDirector(): ?Usuario
    {
        return $this->director;
    }

    public function setDirector(?Usuario $director): static
    {
        $this->director = $director;

        return $this;
    }

    /**
     * @return Collection<int, Character>
     */
    public function getCharacters(): Collection
    {
        return $this->characters;
    }

    public function addCharacter(Character $character): static
    {
        if (!$this->characters->contains($character)) {
            $this->characters->add($character);
            $character->setGame($this);
        }

        return $this;
    }

    public function removeCharacter(Character $character): static
    {
        if ($this->characters->removeElement($character)) {
            // set the owning side to null (unless already changed)
            if ($character->getGame() === $this) {
                $character->setGame(null);
            }
        }

        return $this;
    }
}

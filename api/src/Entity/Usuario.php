<?php

namespace App\Entity;

use ApiPlatform\Doctrine\Orm\Filter\SearchFilter;
use ApiPlatform\Metadata\ApiFilter;
use ApiPlatform\Metadata\ApiProperty;
use ApiPlatform\Metadata\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;
use function Symfony\Component\String\u;

#[ApiResource(types: ['https://schema.org/Person'], mercure: true)]
#[ORM\Entity]
#[ApiFilter(SearchFilter::class, properties: ['id' => 'exact', 'email' => 'partial'])]
class Usuario
{
    /**
     * The entity ID
     */
    #[ORM\Id]
    #[ORM\Column(type: 'integer')]
    #[ORM\GeneratedValue(strategy: 'SEQUENCE')]
    #[Groups(['treasure:read'])]
    private ?int $id = null;

    /**
     * A nice person
     */
    #[ORM\Column]
    #[Assert\NotBlank]
    #[ApiProperty(iris: ["https://schema.org/name"])]
    #[ApiFilter(SearchFilter::class, strategy: 'partial')]
    public string $name = '';

    #[Groups(['treasure:read'])]
    public function getInitials(): string
    {
        return u($this->name)->truncate(2);
    }

    /** The user's email  */
    #[ORM\Column]
    #[Assert\Email]
    #[ApiProperty(iris: ["https://schema.org/email"])]
    public string $email = "a@a";

    /**
     * @var Collection<int, Choir>
     */
    #[ORM\OneToMany(mappedBy: 'usuario', targetEntity: Choir::class)]
    private Collection $choirs;

    /**
     * @var Collection<int, Player>
     */
    #[ORM\OneToMany(mappedBy: 'usuario', targetEntity: Player::class)]
    private Collection $players;

    /**
     * @var Collection<int, Game>
     */
    #[ORM\OneToMany(mappedBy: 'director', targetEntity: Game::class)]
    private Collection $gamesDirecting;

    public function __construct()
    {
        $this->choirs = new ArrayCollection();
        $this->players = new ArrayCollection();
        $this->gamesDirecting = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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
            $choir->setUsuario($this);
        }

        return $this;
    }

    public function removeChoir(Choir $choir): static
    {
        if ($this->choirs->removeElement($choir)) {
            // set the owning side to null (unless already changed)
            if ($choir->getUsuario() === $this) {
                $choir->setUsuario(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Player>
     */
    public function getPlayers(): Collection
    {
        return $this->players;
    }

    public function addPlayer(Player $player): static
    {
        if (!$this->players->contains($player)) {
            $this->players->add($player);
            $player->setUsuario($this);
        }

        return $this;
    }

    public function removePlayer(Player $player): static
    {
        if ($this->players->removeElement($player)) {
            // set the owning side to null (unless already changed)
            if ($player->getUsuario() === $this) {
                $player->setUsuario(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Game>
     */
    public function getGamesDirecting(): Collection
    {
        return $this->gamesDirecting;
    }

    public function addGamesDirecting(Game $gamesDirecting): static
    {
        if (!$this->gamesDirecting->contains($gamesDirecting)) {
            $this->gamesDirecting->add($gamesDirecting);
            $gamesDirecting->setDirector($this);
        }

        return $this;
    }

    public function removeGamesDirecting(Game $gamesDirecting): static
    {
        if ($this->gamesDirecting->removeElement($gamesDirecting)) {
            // set the owning side to null (unless already changed)
            if ($gamesDirecting->getDirector() === $this) {
                $gamesDirecting->setDirector(null);
            }
        }

        return $this;
    }
}

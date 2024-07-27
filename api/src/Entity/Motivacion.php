<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\MotivacionRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MotivacionRepository::class)]
#[ApiResource]
class Motivacion
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'motivacions')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Character $character = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $afirmacion = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $pregunta = null;

    #[ORM\ManyToOne(inversedBy: 'vinculaciones')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Character $vinculacion = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCharacter(): ?Character
    {
        return $this->character;
    }

    public function setCharacter(?Character $character): static
    {
        $this->character = $character;

        return $this;
    }

    public function getAfirmacion(): ?string
    {
        return $this->afirmacion;
    }

    public function setAfirmacion(string $afirmacion): static
    {
        $this->afirmacion = $afirmacion;

        return $this;
    }

    public function getPregunta(): ?string
    {
        return $this->pregunta;
    }

    public function setPregunta(string $pregunta): static
    {
        $this->pregunta = $pregunta;

        return $this;
    }

    public function getVinculacion(): ?Character
    {
        return $this->vinculacion;
    }

    public function setVinculacion(?Character $vinculacion): static
    {
        $this->vinculacion = $vinculacion;

        return $this;
    }
}

<?php

namespace App\Entity;

use App\Repository\AnimalesRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\UX\Turbo\Attribute\Broadcast;

#[ORM\Entity(repositoryClass: AnimalesRepository::class)]
#[Broadcast]
class Animales
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $Nombre = null;

    #[ORM\Column(length: 255)]
    private ?string $Especie = null;

    #[ORM\Column(length: 255)]
    private ?string $Edad = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNombre(): ?string
    {
        return $this->Nombre;
    }

    public function setNombre(string $Nombre): static
    {
        $this->Nombre = $Nombre;

        return $this;
    }

    public function getEspecie(): ?string
    {
        return $this->Especie;
    }

    public function setEspecie(string $Especie): static
    {
        $this->Especie = $Especie;

        return $this;
    }

    public function getEdad(): ?string
    {
        return $this->Edad;
    }

    public function setEdad(string $Edad): static
    {
        $this->Edad = $Edad;

        return $this;
    }
}

<?php

namespace App\Entity;

use App\Repository\TechnicalDetailRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: TechnicalDetailRepository::class)]
class TechnicalDetail
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['default'])]
    private int $id;

    #[ORM\Column(length: 255, nullable: false)]
    #[Groups(['default'])]
    private string $name;

    #[ORM\Column(length: 255, nullable: false)]
    #[Groups(['default'])]
    private string $value;

    #[ORM\ManyToOne(inversedBy: 'technicalDetails')]
    private ?Vehicle $vehicle = null;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): static
    {
        $this->id = $id;

        return $this;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getValue(): string
    {
        return $this->value;
    }

    public function setValue(string $value): static
    {
        $this->value = $value;

        return $this;
    }

    public function getVehicle(): ?Vehicle
    {
        return $this->vehicle;
    }

    public function setVehicle(?Vehicle $vehicle): static
    {
        $this->vehicle = $vehicle;

        return $this;
    }
}

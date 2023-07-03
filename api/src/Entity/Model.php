<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
class Model
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private int $id;

    #[ORM\Column(length: 255, nullable: false)]
    private string $name;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private Make $make;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private Type $type;

    public function getId(): int
    {
        return $this->id;
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

    public function getMake(): Make
    {
        return $this->make;
    }

    public function setMake(Make $make): static
    {
        $this->make = $make;

        return $this;
    }

    public function getType(): Type
    {
        return $this->type;
    }

    public function setType(Type $type): static
    {
        $this->type = $type;

        return $this;
    }
}

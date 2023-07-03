<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
class Vehicle
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private int $id;

    #[ORM\Column(nullable: false)]
    private int $year;

    #[ORM\Column(length: 17, nullable: false)]
    private string $vin;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private Model $model;

    #[ORM\OneToMany(mappedBy: 'vehicle', targetEntity: TechnicalDetail::class)]
    private Collection $technicalDetails;

    public function __construct()
    {
        $this->technicalDetails = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getYear(): ?int
    {
        return $this->year;
    }

    public function setYear(int $year): static
    {
        $this->year = $year;

        return $this;
    }

    public function getVin(): ?string
    {
        return $this->vin;
    }

    public function setVin(string $vin): static
    {
        $this->vin = $vin;

        return $this;
    }

    public function getModel(): ?Model
    {
        return $this->model;
    }

    public function setModel(?Model $model): static
    {
        $this->model = $model;

        return $this;
    }

    public function getTechnicalDetails(): Collection
    {
        return $this->technicalDetails;
    }

    public function setTechnicalDetails(array $technicalDetails): static
    {
        foreach ($technicalDetails as $technicalDetail) {
            $this->addTechnicalDetail($technicalDetail);
        }

        return $this;
    }

    public function addTechnicalDetail(TechnicalDetail $technicalDetail): static
    {
        if ($this->technicalDetails->count() < 10 && !$this->technicalDetails->contains($technicalDetail)) {
            $this->technicalDetails->add($technicalDetail);
            $technicalDetail->setVehicle($this);
        }

        return $this;
    }

    public function removeTechnicalDetail(TechnicalDetail $technicalDetail): static
    {
        if ($this->technicalDetails->removeElement($technicalDetail)) {
            // set the owning side to null (unless already changed)
            if ($technicalDetail->getVehicle() === $this) {
                $technicalDetail->setVehicle(null);
            }
        }

        return $this;
    }
}

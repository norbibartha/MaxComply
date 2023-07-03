<?php

namespace App\Services;

use App\Entity\Make;
use Doctrine\ORM\EntityManagerInterface;

class MakeService
{
    public function __construct(private readonly EntityManagerInterface $entityManager)
    {
    }

    public function getAllMakers(): array
    {
        return $this->entityManager->getRepository(Make::class)->findAll();
    }
}
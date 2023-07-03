<?php

namespace App\Services;

use App\Entity\TechnicalDetail;
use App\Repository\TechnicalDetailRepository;
use Symfony\Component\Routing\Exception\InvalidParameterException;

class TechnicalDetailService
{
    public function __construct(private readonly TechnicalDetailRepository $technicalDetailRepository)
    {
    }

    public function updateTechnicalDetail(TechnicalDetail $technicalDetail, string $value): TechnicalDetail
    {
        if (empty($value)) {
            throw new InvalidParameterException('Technical details could not have empty values!');
        }

        $technicalDetail->setValue($value);
        $this->technicalDetailRepository->save($technicalDetail, true);

        return $this->technicalDetailRepository->findOneBy(['id' => $technicalDetail->getId()]);
    }
}
<?php

namespace App\Tests;

use App\Entity\TechnicalDetail;
use App\Repository\TechnicalDetailRepository;
use App\Services\TechnicalDetailService;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Routing\Exception\InvalidParameterException;

class TechnicalDetailServiceTest extends TestCase
{
    private TechnicalDetailRepository $technicalDetailRepository;
    private TechnicalDetailService $technicalDetailService;

    protected function setUp(): void
    {
        $this->technicalDetailRepository = $this->createMock(TechnicalDetailRepository::class);
        $this->technicalDetailService = new TechnicalDetailService($this->technicalDetailRepository);
    }

    /**
     * @dataProvider updateTechnicalDetailProvider
     */
    public function testUpdateTechnicalDetail(
        TechnicalDetail $technicalDetail,
        TechnicalDetail $dbTechnicalDetail,
        string $value,
        string $expectedResult
    ): void {

        $this->technicalDetailRepository->method('findOneBy')->willReturn($dbTechnicalDetail);

        $result = $this->technicalDetailService->updateTechnicalDetail($technicalDetail, $value);

        $this->assertEquals($expectedResult, $result->getValue());
    }


    public function updateTechnicalDetailProvider(): array
    {
        $technicalDetail = new TechnicalDetail();
        $technicalDetail
            ->setId(1)
            ->setName('Engine power')
            ->setValue('150 hp');

        $dbTechnicalDetail = new TechnicalDetail();
        $dbTechnicalDetail
            ->setId(1)
            ->setName('Engine power')
            ->setValue('149 hp');

        return [
            'Success' => [
                'technicalDetail' => $technicalDetail,
                'dbTechnicalDetail' => $dbTechnicalDetail,
                'value' => '149 hp',
                'expectedResult' => '149 hp',
            ],
        ];
    }

    /**
     * @dataProvider updateTechnicalDetailExceptionProvider
     */
    public function testUpdateTechnicalDetailException(
        TechnicalDetail $technicalDetail,
        string $expectedExceptionClass,
        string $expectedExceptionMessage
    ): void {
        $this->expectException($expectedExceptionClass);
        $this->expectExceptionMessage($expectedExceptionMessage);

        $this->technicalDetailService->updateTechnicalDetail($technicalDetail, '');
    }

    public function updateTechnicalDetailExceptionProvider(): array
    {
        $technicalDetail = new TechnicalDetail();
        $technicalDetail
            ->setId(1)
            ->setName('Engine power')
            ->setValue('150 hp');

        return [
            'Throw exception' => [
                'technicalDetail' => $technicalDetail,
                'expectedExceptionClass' => InvalidParameterException::class,
                'expectedExceptionMessage' => 'Technical details could not have empty values!',
            ],
        ];
    }
}

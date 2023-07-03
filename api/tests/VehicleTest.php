<?php

namespace App\Tests;

use App\Entity\Make;
use App\Entity\Model;
use App\Entity\TechnicalDetail;
use App\Entity\Type;
use App\Entity\Vehicle;
use PHPUnit\Framework\TestCase;

class VehicleTest extends TestCase
{
    private Vehicle $vehicle;

    protected function setUp(): void
    {
        $make = new Make();
        $make->setName('Land Rover');

        $type = new Type();
        $type->setName('Automobile');

        $model = new Model();
        $model->setName('Freelander')
            ->setMake($make)
            ->setType($type);

        $this->vehicle = new Vehicle();
        $this->vehicle
            ->setYear(2020)
            ->setVin('1GNDT13W5R2133070')
            ->setModel($model);
    }

    /**
     * @dataProvider addTechnicalDetailProvider
     */
    public function testAddTechnicalDetail(TechnicalDetail $technicalDetail, int $expectedResult): void
    {
        $this->vehicle->addTechnicalDetail($technicalDetail);

        $this->assertEquals($expectedResult, $this->vehicle->getTechnicalDetails()->count());
    }

    public function addTechnicalDetailProvider(): array
    {
        $technicalDetail = new TechnicalDetail();
        $technicalDetail
            ->setId(1)
            ->setName('Top speed')
            ->setValue('248 km/h');

        return [
            'Success' => [
                'technicalDetail' => $technicalDetail,
                'expectedResult' => 1,
            ],
        ];
    }

    /**
     * @dataProvider removeTechnicalDetailProvider
     */
    public function testRemoveTechnicalDetail(TechnicalDetail $technicalDetail, int $expectedResult): void
    {
        $this->vehicle->addTechnicalDetail($technicalDetail);
        $this->vehicle->removeTechnicalDetail($technicalDetail);

        $this->assertEquals($expectedResult, $this->vehicle->getTechnicalDetails()->count());
    }

    public function removeTechnicalDetailProvider(): array
    {
        $technicalDetail = new TechnicalDetail();
        $technicalDetail
            ->setId(1)
            ->setName('Engine power')
            ->setValue('150 hp');

        return [
            'Success' => [
                'technicalDetail' => $technicalDetail,
                'expectedResult' => 0,
            ],
        ];
    }
}

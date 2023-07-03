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
     * @dataProvider addMultipleTechnicalDetailProvider
     */
    public function testAddMultipleTechnicalDetail(
        array $technicalDetails,
        int $expectedResult
    ): void {
        foreach ($technicalDetails as $technicalDetail) {
            $this->vehicle->addTechnicalDetail($technicalDetail);
        }

        $this->assertEquals($expectedResult, $this->vehicle->getTechnicalDetails()->count());
    }

    public function addMultipleTechnicalDetailProvider(): array
    {
        $technicalDetails = [
            (new TechnicalDetail())->setName('name1')->setValue('value1'),
            (new TechnicalDetail())->setName('name2')->setValue('value2'),
            (new TechnicalDetail())->setName('name3')->setValue('value3'),
            (new TechnicalDetail())->setName('name4')->setValue('value4'),
            (new TechnicalDetail())->setName('name5')->setValue('value5'),
            (new TechnicalDetail())->setName('name6')->setValue('value6'),
            (new TechnicalDetail())->setName('name7')->setValue('value7'),
            (new TechnicalDetail())->setName('name8')->setValue('value8'),
            (new TechnicalDetail())->setName('name9')->setValue('value9'),
            (new TechnicalDetail())->setName('name10')->setValue('value10'),
            (new TechnicalDetail())->setName('name11')->setValue('value11'),
            (new TechnicalDetail())->setName('name12')->setValue('value12'),
            (new TechnicalDetail())->setName('name13')->setValue('value13'),
            (new TechnicalDetail())->setName('name14')->setValue('value14'),
            (new TechnicalDetail())->setName('name15')->setValue('value15'),
        ];

        return [
            'Success' => [
                'technicalDetails' => $technicalDetails,
                'expectedResult' => 10,
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

<?php

namespace App\DataFixtures;

use App\Entity\Make;
use App\Entity\Model;
use App\Entity\TechnicalDetail;
use App\Entity\Type;
use App\Entity\Vehicle;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // Create Make entities
        $mazda = (new Make())->setName('Mazda');
        $landRover = (new Make())->setName('Land Rover');

        $manager->persist($mazda);
        $manager->persist($landRover);

        // Create Type entity
        $type = (new Type())->setName('Automobile');
        $manager->persist($type);


        // Create Model entities
        $modelEvoque = new Model();
        $modelEvoque->setName('Range Rover Evoque')
            ->setType($type)
            ->setMake($landRover);

        $modelFreelander = new Model();
        $modelFreelander->setName('Freelander')
            ->setType($type)
            ->setMake($landRover);

        $modelMx5 = new Model();
        $modelMx5->setName('MX-5')
            ->setType($type)
            ->setMake($mazda);

        $manager->persist($modelEvoque);
        $manager->persist($modelFreelander);
        $manager->persist($modelMx5);

        // Create TechnicalDetail entities
        $mx5TechnicalDetails = $this->buildTechnicalDetails(
            topSpeedValue: '219 km/h',
            accelerationValue: '6.5s',
            engineCodeValue: 'SkyActiv-G',
            engineSizeValue: '1998 cc',
            fuelConsumptionValue: '6.9 l/100 km',
            fuelTypeValue: 'Petrol (Gasoline)',
            powerValue: '184 Hp @ 7000 rpm',
            torqueValue: '205 Nm @ 4000 rpm',
            engineAspirationValue: 'Naturally aspirated engine',
            weightValue: '1025 kg',
        );
        $rangeRoverEvoqueTechnicalDetails = $this->buildTechnicalDetails(
            topSpeedValue: '242 km/h',
            accelerationValue: '6.6s',
            engineCodeValue: '190513 204PT',
            engineSizeValue: '1998 cc',
            fuelConsumptionValue: '8.1 l/100 km',
            fuelTypeValue: 'Petrol (Gasoline)',
            powerValue: '300 Hp @ 5500 rpm',
            torqueValue: '400 Nm @ 1500-4500 rpm',
            engineAspirationValue: 'Twin-Turbo, Intercooler',
            weightValue: '1925 kg',
        );
        $freelanderTechnicalDetails = $this->buildTechnicalDetails(
            topSpeedValue: '181 km/h',
            accelerationValue: '11.2s',
            engineCodeValue: '224DT',
            engineSizeValue: '2179 cc',
            fuelConsumptionValue: '8.7 l/100 km',
            fuelTypeValue: 'Diesel',
            powerValue: '150 Hp @ 4000 rpm',
            torqueValue: '420 Nm @ 1750 rpm',
            engineAspirationValue: 'Turbocharger, Intercooler',
            weightValue: '1805 kg',
        );

        foreach ($mx5TechnicalDetails as $technicalDetail) {
            $manager->persist($technicalDetail);
        }

        foreach ($rangeRoverEvoqueTechnicalDetails as $technicalDetail) {
            $manager->persist($technicalDetail);
        }

        foreach ($freelanderTechnicalDetails as $technicalDetail) {
            $manager->persist($technicalDetail);
        }

        // Create Vehicle entities
        $mazdaMx5 = new Vehicle();
        $mazdaMx5
            ->setModel($modelMx5)
            ->setTechnicalDetails($mx5TechnicalDetails)
            ->setYear(2018)
            ->setVin('4Y1SL65848Z411439');

        $rangeRoverEvoque = new Vehicle();
        $rangeRoverEvoque
            ->setModel($modelEvoque)
            ->setTechnicalDetails($rangeRoverEvoqueTechnicalDetails)
            ->setYear(2023)
            ->setVin('JH4DA3453GS006314');

        $landRoverFreelander = new Vehicle();
        $landRoverFreelander
            ->setModel($modelFreelander)
            ->setTechnicalDetails($freelanderTechnicalDetails)
            ->setYear(2012)
            ->setVin('SCFAB22311K301756');

        $manager->persist($mazdaMx5);
        $manager->persist($rangeRoverEvoque);
        $manager->persist($landRoverFreelander);

        $manager->flush();
    }

    private function buildTechnicalDetails(
        string $topSpeedValue,
        string $accelerationValue,
        string $engineCodeValue,
        string $engineSizeValue,
        string $fuelConsumptionValue,
        string $fuelTypeValue,
        string $powerValue,
        string $torqueValue,
        string $engineAspirationValue,
        string $weightValue,
    ): array {
        return [
            (new TechnicalDetail())->setName('Top speed')->setValue($topSpeedValue),
            (new TechnicalDetail())->setName('Acceleration 0-100 km/h')->setValue($accelerationValue),
            (new TechnicalDetail())->setName('Engine code')->setValue($engineCodeValue),
            (new TechnicalDetail())->setName('Engine cubic capacity')->setValue($engineSizeValue),
            (new TechnicalDetail())->setName('Fuel consumption')->setValue($fuelConsumptionValue),
            (new TechnicalDetail())->setName('Fuel type')->setValue($fuelTypeValue),
            (new TechnicalDetail())->setName('Power')->setValue($powerValue),
            (new TechnicalDetail())->setName('Torque')->setValue($torqueValue),
            (new TechnicalDetail())->setName('Engine aspiration')->setValue($engineAspirationValue),
            (new TechnicalDetail())->setName('Weight')->setValue($weightValue),
        ];
    }
}

<?php

namespace App\DataFixtures;

use App\Factory\SubcontractorFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use function Zenstruck\Foundry\faker;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // Subcontractors with all values
        SubcontractorFactory::createMany(4, [
            'price'      => faker()->numberBetween(10_000_00, 10_000_000_00),
            'discount'   => faker()->numberBetween(1_000_00, 100_000_00),
            'adjustment' => faker()->numberBetween(1_000_00, 100_000_00),
            'unletCost'  => faker()->numberBetween(100_00, 100_000_00),
        ]);

        // Subcontractors with no values
        SubcontractorFactory::createMany(3);

        // Subcontractors with partial values
        SubcontractorFactory::createMany(2, [
            'price'     => faker()->numberBetween(10_000_00, 10_000_000_00),
            'unletCost' => faker()->numberBetween(100_00, 100_000_00),
        ]);
        SubcontractorFactory::createMany(2, [
            'price'    => faker()->numberBetween(10_000_00, 10_000_000_00),
            'discount' => faker()->numberBetween(1_000_00, 100_000_00),
        ]);

        // Subcontractor with known values
        SubcontractorFactory::createOne([
            'name'      => 'Concrete Bros.',
            'price'     => 50_000_00,
            'discount'  => 5_000_00,
            'unletCost' => 500_00,
        ]);
    }
}

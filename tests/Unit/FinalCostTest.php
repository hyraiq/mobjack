<?php

declare(strict_types=1);

namespace App\Tests\Unit;

use App\Core\FinalCost;
use App\Entity\Subcontractor;
use Faker\Factory;
use PHPUnit\Framework\TestCase;

class FinalCostTest extends TestCase
{
    public function testFinalCostWithPriceOnly(): void
    {
        $faker = Factory::create();

        $subcontractor = (new Subcontractor($faker->company()))
            ->setPrice(50_000_00)
        ;

        $finalCost = FinalCost::calculate($subcontractor);

        static::assertSame(50_000_00, $finalCost);
    }
}

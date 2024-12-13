<?php

declare(strict_types=1);

namespace App\Tests\Functional;

use App\Factory\SubcontractorFactory;
use Zenstruck\Foundry\Test\Factories;
use Zenstruck\Foundry\Test\ResetDatabase;

class PatchSubcontractorTest extends BaseWebTestCase
{
    use Factories, ResetDatabase;

    public function testPatchSomeProperties(): void
    {
        $subcontractor = SubcontractorFactory::createOne([
            'name'      => 'Concrete Bros.',
            'price'     => 50_000_00,
            'unletCost' => 500_00,
        ]);

        $response = $this->doPatchRequest(
            \sprintf('/subcontractors/%s', (string) $subcontractor->getId()),
            [
                'name'        => 'Concrete Bros.',
                'price'       => 560_000_00,
                'adjustments' => 15_000_00,
            ],
        );

        static::assertSame(204, $response->getStatusCode());

        static::assertSame('Concrete Bros.', $subcontractor->getName());
        static::assertSame(560_000_00, $subcontractor->getPrice());
        static::assertNull($subcontractor->getDiscount());
        static::assertSame(15_000_00, $subcontractor->getAdjustment());
        static::assertSame(500_00, $subcontractor->getUnletCost());
    }
}

<?php

declare(strict_types=1);

namespace App\Tests\Functional;

use App\Entity\Subcontractor;
use Faker\Factory;
use Hautelook\AliceBundle\PhpUnit\ReloadDatabaseTrait;

class PatchSubcontractorTest extends BaseWebTestCase
{
    use ReloadDatabaseTrait;

    public function testPatchSomeProperties(): void
    {
        /** @var Subcontractor $subcontractor */
        $subcontractor = static::$fixtures['subcontractor_some_1'];

        $originalUnletCost = $subcontractor->getUnletCost();

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
        static::assertSame($originalUnletCost, $subcontractor->getUnletCost());
    }
}

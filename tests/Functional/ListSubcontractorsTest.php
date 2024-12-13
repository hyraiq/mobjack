<?php

declare(strict_types=1);

namespace App\Tests\Functional;

use App\Factory\SubcontractorFactory;
use App\Utility\ArrayUtility;
use Zenstruck\Foundry\Test\Factories;
use Zenstruck\Foundry\Test\ResetDatabase;
use function Zenstruck\Foundry\faker;

class ListSubcontractorsTest extends BaseWebTestCase
{
    use Factories, ResetDatabase;

    public function testListSubcontractors(): void
    {
        // A few random subbies
        SubcontractorFactory::createMany(10, [
            'price'      => faker()->numberBetween(10_000_00, 10_000_000_00),
            'discount'   => faker()->numberBetween(1_000_00, 100_000_00),
            'adjustment' => faker()->numberBetween(1_000_00, 100_000_00),
            'unletCost'  => faker()->numberBetween(100_00, 100_000_00),
        ]);

        // Subbie with known values
        $knownSubbie = SubcontractorFactory::createOne([
            'name'      => 'Concrete Bros.',
            'price'     => 50_000_00,
            'discount'  => 5_000_00,
            'unletCost' => 500_00,
        ]);

        $response = $this->doGetRequest('/subcontractors');

        static::assertSame(200, $response->getStatusCode());
        $content = $this->decodeResponse($response);

        static::assertCount(11, $content);

        $knownSubbieDetails = ArrayUtility::arrayFind(
            $content,
            fn(mixed $data) => is_array($data) && (($data['id'] ?? null) === $knownSubbie->getId()),
        );

        static::assertIsArray($knownSubbieDetails);
        static::assertSame('Concrete Bros.', $knownSubbieDetails['name'] ?? -1);
        static::assertSame(50_000_00, $knownSubbieDetails['price'] ?? -1);
        static::assertSame(5_000_00, $knownSubbieDetails['discount'] ?? -1);
        static::assertSame(500_00, $knownSubbieDetails['unletCost'] ?? -1);

        static::assertArrayHasKey('adjustment', $knownSubbieDetails);
        static::assertNull($knownSubbieDetails['adjustment']);
    }
}

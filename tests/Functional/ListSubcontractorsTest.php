<?php

declare(strict_types=1);

namespace App\Tests\Functional;

use App\Entity\Subcontractor;
use App\Utility\ArrayUtility;
use Hautelook\AliceBundle\PhpUnit\FixtureStore;
use Hautelook\AliceBundle\PhpUnit\ReloadDatabaseTrait;

class ListSubcontractorsTest extends BaseWebTestCase
{
    use ReloadDatabaseTrait;

    public function testListSubcontractors(): void
    {
        /** @var Subcontractor $knownSubbie */
        $knownSubbie = FixtureStore::getFixtures()['subcontractor_known'];

        $response = $this->doGetRequest('/subcontractors');

        static::assertSame(200, $response->getStatusCode());
        $content = $this->decodeResponse($response);

        static::assertCount(13, $content);

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

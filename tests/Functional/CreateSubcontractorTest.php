<?php

declare(strict_types=1);

namespace App\Tests\Functional;

use App\Entity\Subcontractor;
use Doctrine\ORM\EntityManagerInterface;
use Hautelook\AliceBundle\PhpUnit\ReloadDatabaseTrait;

class CreateSubcontractorTest extends BaseWebTestCase
{
    use ReloadDatabaseTrait;

    public function testSubcontractorCreatedWithName(): void
    {
        $response = $this->doPostRequest('/subcontractors', ['name' => 'Concrete Bros.']);

        static::assertSame(201, $response->getStatusCode());
        $content = $this->decodeResponse($response);
        static::assertArrayHasKey('id', $content);

        /** @var EntityManagerInterface $entityManager */
        $entityManager = static::getContainer()->get(EntityManagerInterface::class);
        $subcontractor = $entityManager->find(Subcontractor::class, $content['id']);
        static::assertInstanceOf(Subcontractor::class, $subcontractor);

        static::assertSame('Concrete Bros.', $subcontractor->getName());
        static::assertNull($subcontractor->getPrice());
        static::assertNull($subcontractor->getDiscount());
        static::assertNull($subcontractor->getAdjustment());
        static::assertNull($subcontractor->getUnletCost());
    }

    public function testCannotCreateWithoutName(): void
    {
        $response = $this->doPostRequest('/subcontractors', []);

        static::assertSame(400, $response->getStatusCode());
    }
}

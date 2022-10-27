<?php

namespace App\Tests\Functional;

use App\Entity\Subcontractor;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class CreateSubcontractorTest extends AbstractWebTestCase
{
    public function testSubcontractorCreatedWithName(): void
    {
        $response = $this->postRequest('/subcontractor', ['name' => 'Concrete Bros.']);

        static::assertSame(201, $response->getStatusCode());
        $content = (array) $response->getContent();
        static::assertArrayHasKey('id', $content);

        $subcontractor = static::getContainer()->get(EntityManagerInterface::class)->find(Subcontractor::class, $content['id']);
        static::assertInstanceOf(Subcontractor::class, $subcontractor);

        static::assertSame('Concrete Bros.', $subcontractor->getName());
        static::assertNull($subcontractor->getPrice());
        static::assertNull($subcontractor->getDiscount());
        static::assertNull($subcontractor->getAdjustment());
        static::assertNull($subcontractor->getUnletCost());
    }
}

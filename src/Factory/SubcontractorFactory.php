<?php

namespace App\Factory;

use App\Entity\Subcontractor;
use Zenstruck\Foundry\Persistence\PersistentProxyObjectFactory;

/**
 * @extends PersistentProxyObjectFactory<Subcontractor>
 */
final class SubcontractorFactory extends PersistentProxyObjectFactory
{
    public static function class(): string
    {
        return Subcontractor::class;
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#model-factories
     */
    protected function defaults(): array|callable
    {
        return [
            'name' => self::faker()->company(),
        ];
    }
}

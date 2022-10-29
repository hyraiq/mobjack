<?php

declare(strict_types=1);

namespace App\Core;

use App\Entity\Subcontractor;

final class FinalCost
{
    private function __construct()
    {
    }

    public static function calculate(Subcontractor $subcontractor): int
    {
        throw new \LogicException('Not implemented');
    }
}

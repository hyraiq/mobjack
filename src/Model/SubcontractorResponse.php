<?php

declare(strict_types=1);

namespace App\Model;

use App\Core\FinalCost;
use App\Entity\Subcontractor;

final class SubcontractorResponse
{
    public readonly ?int $id;

    public readonly string $name;

    public readonly ?int $price;

    public readonly ?int $discount;

    public readonly ?int $adjustment;

    public readonly ?int $unletCost;

    public readonly ?int $finalCost;

    public function __construct(Subcontractor $subcontractor)
    {
        $this->id         = $subcontractor->getId();
        $this->name       = $subcontractor->getName();
        $this->price      = $subcontractor->getPrice();
        $this->discount   = $subcontractor->getDiscount();
        $this->adjustment = $subcontractor->getAdjustment();
        $this->unletCost  = $subcontractor->getUnletCost();
        $this->finalCost  = FinalCost::calculate($subcontractor);
    }
}

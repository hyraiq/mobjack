<?php

declare(strict_types=1);

namespace App\Entity;

use App\Repository\SubcontractorRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SubcontractorRepository::class)]
class Subcontractor
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private string $name;

    #[ORM\Column(nullable: true)]
    private ?int $price = null;

    #[ORM\Column(nullable: true)]
    private ?int $discount = null;

    #[ORM\Column(nullable: true)]
    private ?int $adjustment = null;

    #[ORM\Column(nullable: true)]
    private ?int $unletCost = null;

    public function __construct(string $name)
    {
        $this->name = $name;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getPrice(): ?int
    {
        return $this->price;
    }

    public function setPrice(int $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getDiscount(): ?int
    {
        return $this->discount;
    }

    public function setDiscount(int $discount): self
    {
        $this->discount = $discount;

        return $this;
    }

    public function getAdjustment(): ?int
    {
        return $this->adjustment;
    }

    public function setAdjustment(int $adjustment): self
    {
        $this->adjustment = $adjustment;

        return $this;
    }

    public function getUnletCost(): ?int
    {
        return $this->unletCost;
    }

    public function setUnletCost(int $unletCost): self
    {
        $this->unletCost = $unletCost;

        return $this;
    }
}

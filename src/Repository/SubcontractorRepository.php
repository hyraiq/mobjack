<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\Subcontractor;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Subcontractor>
 *
 * @method Subcontractor|null find($id, $lockMode = null, $lockVersion = null)
 * @method Subcontractor|null findOneBy(array $criteria, array $orderBy = null)
 * @method Subcontractor[]    findAll()
 * @method Subcontractor[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 *
 * @psalm-method list<Subcontractor>    findAll()
 * @psalm-method list<Subcontractor>    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
final class SubcontractorRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Subcontractor::class);
    }
}

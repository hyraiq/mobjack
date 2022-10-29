<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\Subcontractor;
use App\Model\SubcontractorResponse;
use App\Repository\SubcontractorRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

final class ListSubcontractorsController extends AbstractController
{
    public function __construct(
        private readonly SubcontractorRepository $subcontractorRepository,
    ) {
    }

    #[Route('/subcontractors', methods: ['GET'])]
    public function __invoke(Request $request): Response
    {
        $subcontractors = $this->subcontractorRepository->findAll();

        $response = \array_map(
            fn(Subcontractor $sub) => new SubcontractorResponse($sub),
            $subcontractors,
        );

        return $this->json($response, 200);
    }
}

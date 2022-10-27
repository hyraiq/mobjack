<?php

namespace App\Controller;

use App\Entity\Subcontractor;
use App\Model\CreateSubcontractor;
use App\Services\RequestHandler;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

final class CreateSubcontractorController extends AbstractController
{
    public function __construct(
        private readonly RequestHandler         $handler,
        private readonly EntityManagerInterface $entityManager,
    ) {
    }

    #[Route('/subcontractor', methods: ['POST'])]
    public function __invoke(Request $request): Response
    {
        $model = $this->handler->parse($request, CreateSubcontractor::class);

        $subcontractor = new Subcontractor($model->name);

        $this->entityManager->persist($subcontractor);
        $this->entityManager->flush();

        return $this->json($subcontractor, 201);
    }
}

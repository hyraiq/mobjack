<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\Subcontractor;
use App\Model\CreateSubcontractor;
use App\Services\RequestHandler;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\Routing\Annotation\Route;

final class CreateSubcontractorController extends AbstractController
{
    public function __construct(
        private readonly RequestHandler         $handler,
        private readonly EntityManagerInterface $entityManager,
    ) {
    }

    #[Route('/subcontractors', methods: ['POST'])]
    public function __invoke(Request $request): Response
    {
        /** @var CreateSubcontractor $model */
        $model = $this->handler->parse($request, CreateSubcontractor::class);

        if ('' === $model->name) {
            throw new BadRequestHttpException('Name is required');
        }

        $subcontractor = new Subcontractor($model->name);

        $this->entityManager->persist($subcontractor);
        $this->entityManager->flush();

        return $this->json($subcontractor, 201);
    }
}

<?php

namespace App\Controller;

use App\Dto\InterventionDto\InterventionDto;
use App\Entity\Module;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('api/test')]
class DummyController extends AbstractController
{
    /**
     * Get all interventions
     */
    #[Route('/', name: 'test', methods: ['GET'])]
    public function getTest(Request $request): Response
    {
        return new JsonResponse([
            'message' => 'Hello',
            'translate_key' => '',
            'data' => 'Hello',
        ], Response::HTTP_OK);
    }
}
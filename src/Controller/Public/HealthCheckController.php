<?php

namespace App\Controller\Public;

use App\Controller\AbstractApiController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;

class HealthCheckController extends AbstractApiController
{
    public function __construct()
    {

    }

    /**
     * Handles the heartbeat endpoint to verify the application environment status.
     */
    #[Route('/heartbeat', name: 'heartbeat', methods: ['GET'])]
    public function getHeartbeat(): JsonResponse
    {
        $env = $_ENV['APP_ENV'];

        return new JsonResponse($this->getJsonResponse(['env' => $env], 'ok'));
    }
}
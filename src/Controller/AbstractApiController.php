<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AbstractApiController extends AbstractController
{
    /**
     * Get json response API
     */
    protected function getJsonResponse(string $message, array|string $data = []): array
    {
        return [
            'message' => $message,
            'data' => $data,
        ];
    }
}
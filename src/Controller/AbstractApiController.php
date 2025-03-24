<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AbstractApiController extends AbstractController
{
    /**
     * Get json response API
     */
    protected function getJsonResponse(array|string $data = [], string $message = ''): array
    {
        return [
            'message' => $message,
            'data' => $data,
        ];
    }
}
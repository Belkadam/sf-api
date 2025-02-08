<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('api/test')]
class DummyController extends AbstractApiController
{
    #[Route('/', name: 'test', methods: ['GET'])]
    public function getTest(Request $request): Response
    {
        return new JsonResponse($this->getJsonResponse('Hello', ['Foo' => 'bar']), Response::HTTP_OK);
    }
}
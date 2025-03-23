<?php

namespace App\Controller\auth;

use App\Controller\AbstractApiController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('api/test')]
class DummyController extends AbstractApiController
{
    #[Route('', name: 'test', methods: ['GET'])]
    public function getTest(Request $request): Response
    {
        return new JsonResponse($this->getJsonResponse('Hello', ['Foo' => 'bar']), Response::HTTP_OK);
    }

    #[Route('/ci-cd', name: 'test_ci_cd', methods: ['GET'])]
    public function testCiCd()
    {
        return new JsonResponse($this->getJsonResponse('CI/CD worked 2', ['Foo' => 'bar']), Response::HTTP_OK);
    }
}
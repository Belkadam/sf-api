<?php

namespace App\Controller\Authenticated;

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
        return new JsonResponse($this->getJsonResponse(['Foo' => 'bar'], 'Hello'), Response::HTTP_OK);
    }

    #[Route('/ci-cd', name: 'test_ci_cd', methods: ['GET'])]
    public function testCiCd()
    {
        return new JsonResponse($this->getJsonResponse(['Foo' => 'bar'], 'CI/CD worked 2'), Response::HTTP_OK);
    }
}
<?php

namespace App\Controller\Authenticated;

use App\Controller\AbstractApiController;
use App\Dto\UserDto\UserDto;
use App\Service\UserService;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('api/user', name: 'user_')]
class UserController extends AbstractApiController
{
    public function __construct(private readonly UserService $userService)
    {

    }

    #[Route('', name: 'index', methods: ['GET'])]
    public function index(): JsonResponse
    {
        $users = $this->userService->index();
        $usersDto = [];
        foreach ($users as $user) {
            $usersDto[] = new UserDto($user);
        }

        return new JsonResponse($this->getJsonResponse($usersDto), Response::HTTP_OK);
    }
}
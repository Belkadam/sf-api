<?php

namespace App\Service;
use App\Entity\User;
use App\Repository\UserRepository;

class UserService extends AbstractService
{
    public function __construct(private readonly UserRepository $userRepository)
    {

    }

    /**
     * @return array<int, User>
     */
    public function index(): array
    {
        return $this->userRepository->findAll();
    }
}
<?php

namespace App\Dto\UserDto;

use App\Dto\AbstractDto;
use App\Entity\User;

class UserDto extends AbstractDto
{
    public int $id;
    public string $email;

    public function __construct(User $user)
    {
        $this->id = $user->getId();
        $this->email = $user->getEmail();
    }
}
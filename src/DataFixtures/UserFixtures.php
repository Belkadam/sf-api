<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture
{
    function __construct(private readonly UserPasswordHasherInterface $hasher)
    {

    }

    public function load(ObjectManager $manager): void
    {
        $user = new User();
        $user->setEmail('root@test.com');
        $user->setPassword(
            $this->hasher->hashPassword($user, 'root')
        );

        $manager->persist($user);
        $manager->flush();
        $manager->flush();
    }
}

<?php

namespace App\Controller\Public;

use App\Controller\AbstractApiController;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Lexik\Bundle\JWTAuthenticationBundle\Services\JWTTokenManagerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Attribute\Route;

class LoginController extends AbstractApiController
{
    private JWTTokenManagerInterface $jwtManager;
    private EntityManagerInterface $entityManager;

    public function __construct(JWTTokenManagerInterface $jwtManager, EntityManagerInterface $entityManager)
    {
        $this->jwtManager = $jwtManager;
        $this->entityManager = $entityManager;
    }

    /**
     * Handles user login.
     */
    #[Route('/login', name: 'login', methods: ['POST'])]
    public function login(Request $request,  UserPasswordHasherInterface $passwordHasher): Response
    {
        $data = json_decode($request->getContent(), true);
        $email = $data['email'] ?? '';
        $password = $data['password'] ?? '';

        if (empty($email) || empty($password)) {
            return new JsonResponse(['message' => 'Password required.'], 400);
        }

        try {
            $user = $this->entityManager->getRepository(User::class)->findOneByEmail($email);
            if (!$user || !$passwordHasher->isPasswordValid($user, $password)) {
                return new JsonResponse(['message' => 'Invalid credentials.'], 401);
            }

            $jwt = $this->generateJwt($user);

            return new JsonResponse([
                'userAbilityRules'  => [
                    'action'    => 'read',
                    'subject'   => 'admin',
                ],
                'userData'          => [
                    'message' => 'Authentication successful'
                ],
                'accessToken'       => $jwt,
            ]);

        } catch (\Exception $e) {
            return new JsonResponse(['message' => 'Authentication failed'], 401);
        }
    }

    private function generateJwt($user)
    {
        // Utiliser le service JWT pour générer le token JWT à partir de l'utilisateur
        return $this->jwtManager->create($user);
    }
}
<?php

namespace App\Controller\public;

use App\Controller\AbstractApiController;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Lexik\Bundle\JWTAuthenticationBundle\Services\JWTTokenManagerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

class LoginController extends AbstractApiController
{
    private $jwtManager;
    private $entityManager;


    public function __construct(JWTTokenManagerInterface $jwtManager, EntityManagerInterface $entityManager)
    {
        $this->jwtManager = $jwtManager;
        $this->entityManager = $entityManager;

    }

    #[Route('/login', name: 'login', methods: ['POST'])]
    public function login(Request $request,  UserPasswordHasherInterface $passwordHasher): Response
    {
        // Récupérer les données du POST (email et mot de passe)
        $data = json_decode($request->getContent(), true);
        $email = $data['email'] ?? '';
        $password = $data['password'] ?? '';

        if (empty($email) || empty($password)) {
            return new JsonResponse(['message' => 'Email et mot de passe requis'], 400);
        }

        try {
            // Rechercher l'utilisateur par email avec le gestionnaire d'entités
            $user = $this->entityManager->getRepository(User::class)->findOneByEmail($email);
            if (!$user || !$passwordHasher->isPasswordValid($user, $password)) {
                return new JsonResponse(['message' => 'Email ou mot de passe invalide'], 401);
            }

            // Générer un token JWT pour l'utilisateur authentifié
            $jwt = $this->generateJwt($user);

            return new JsonResponse(['message' => 'Authentication successful', 'token' => $jwt]);

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
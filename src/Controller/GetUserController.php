<?php

namespace App\Controller;

use Doctrine\ORM\EntityManagerInterface;
use Nelmio\ApiDocBundle\Annotation\Security;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;
use Lexik\Bundle\JWTAuthenticationBundle\Services\JWTTokenManagerInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use OpenApi\Attributes as OA;


class GetUserController extends AbstractController
{
    #[Route('/api/user', methods: ['GET'])]
    #[Security(name: 'Bearer')]
    #[OA\Tag(name: 'User')]
    #[OA\Response(
        response: 200,
        description: 'Returns all advices linked to the month id in the path')]
    #[OA\Response(
        response: 401,
        description: 'Unauthorized: user is not logged in')]
    public function __invoke(
        EntityManagerInterface $entityManager,
        TokenStorageInterface $tokenStorageInterface,
        JWTTokenManagerInterface $jwtManager
    ): JsonResponse
    {
        $decodedJwtToken = $jwtManager->decode($tokenStorageInterface->getToken());

        return new JsonResponse($decodedJwtToken);
    }
}

<?php

namespace App\Controller\Books;

use App\Entity\Book;
use Doctrine\ORM\EntityManagerInterface;
use OpenApi\Attributes as OA;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Nelmio\ApiDocBundle\Annotation\Security;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Serializer\SerializerInterface;



class GetAllBooksController extends AbstractController
{
    #[Route('/api/books', methods: ['GET'])]
    #[Security(name: 'Bearer')]
    #[OA\Tag(name: 'Books')]
    #[OA\Response(
        response: 200,
        description: 'Returns all book',)]
    #[OA\Response(
        response: 401,
        description: 'Unauthorized: user is not logged in')]
    public function __invoke(
        EntityManagerInterface $entityManager,
        SerializerInterface $serializer
    ): JsonResponse
    {
        $bookRepository = $entityManager->getRepository(Book::class);

        $books = $bookRepository->findAll();

        $response = $serializer->normalize($books, 'json', ["groups" => "book"]);

        return new JsonResponse($response);
    }
}

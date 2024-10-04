<?php

namespace App\Controller\Books;

use App\Entity\Book;
use Doctrine\ORM\EntityManagerInterface;
use Nelmio\ApiDocBundle\Annotation\Security;
use OpenApi\Attributes as OA;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Serializer\SerializerInterface;


class GetBookByNameController extends AbstractController
{
    #[Route('/api/book/{bookName}', methods: ['GET'])]
    #[Security(name: 'Bearer')]
    #[OA\Tag(name: 'Books')]
    #[OA\Parameter(
        name: "bookName",
        description: "Book's name",
        in: "path",
        required: true,
        schema: new OA\Schema(type: "string", example: 'The Gunslinger')
    )]
    #[OA\Response(
        response: 200,
        description: 'Returns book by name',)]
    #[OA\Response(
        response: 401,
        description: 'Unauthorized: user is not logged in')]
    #[OA\Response(
        response: 400,
        description: 'Bad-request: book does not exist')]
    public function __invoke(
        EntityManagerInterface $entityManager,
        SerializerInterface $serializer,
        string $bookName
    ): JsonResponse
    {
        $bookRepository = $entityManager->getRepository(Book::class);

        $books = $bookRepository->findBy(['title' => $bookName]);


        $response = $serializer->normalize($books, 'json', ["groups" => "book"]);

        return new JsonResponse($response);
    }
}

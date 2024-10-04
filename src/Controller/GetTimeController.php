<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;

class GetTimeController extends AbstractController
{
    #[Route('/time')]
    public function __invoke(): JsonResponse
    {
        $now = new \DateTime();

        return new JsonResponse($now);
    }
}

<?php

namespace App\Controller\Api;

use App\Repository\ApartmentRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class ApartmentApiController extends AbstractController
{
    #[Route('/api/apartments', name: 'api_apartment_index', methods: ['GET'])]
    public function index(ApartmentRepository $apartmentRepository): JsonResponse
    {
        $apartments = $apartmentRepository->findAll();

        $data = array_map(static fn($apartment) => [
            'id' => $apartment->getId(),
            'title' => $apartment->getTitle(),
            'price' => $apartment->getPrice(),
            'rooms' => $apartment->getRooms(),
            'area' => $apartment->getArea(),
            'address' => $apartment->getAddress(),
        ], $apartments);

        return $this->json([
            'status' => 'success',
            'count' => count($data),
            'data' => $data,
        ]);
    }
}

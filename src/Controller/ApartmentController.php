<?php

namespace App\Controller;

use App\Service\ApartmentProvider;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ApartmentController extends AbstractController
{
    private ApartmentProvider $apartmentProvider;

    // Wstrzyknięcie serwisu w konstruktorze
    public function __construct(ApartmentProvider $apartmentProvider)
    {
        $this->apartmentProvider = $apartmentProvider;
    }

    #[Route('/api/apartments', name: 'apartment_index', methods: ['GET'])]
    public function index(): JsonResponse
    {
        // Pobranie mieszkań z serwisu
        $apartments = $this->apartmentProvider->getAllApartments();

        // Zabezpieczenie: jeśli null lub pusta tablica
        if ($apartments === null || empty($apartments)) {
            return $this->json([
                'status' => 'error',
                'message' => 'Brak mieszkań w bazie'
            ], Response::HTTP_NOT_FOUND);
        }

        // Mapowanie danych do JSON (unikamy pustych obiektów)
        $data = array_map(fn($apartment) => [
            'id' => $apartment->getId(),
            'title' => $apartment->getTitle(),
            'description' => $apartment->getDescription(),
            'price' => $apartment->getPrice(),
            'rooms' => $apartment->getRooms(),
            'area' => $apartment->getArea(),
            'address' => $apartment->getAddress(),
            'createdAt' => $apartment->getCreatedAt()->format('Y-m-d H:i:s'),
        ], $apartments);

        //  Zwracamy JSON i zabezpieczamy API (tylko JSON)
        return $this->json([
            'status' => 'success',
            'count' => count($data),
            'data' => $data
        ]);
    }
}

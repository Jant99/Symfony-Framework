<?php

namespace App\Service;

use App\Repository\ApartmentRepository;
use App\Entity\Apartment;

class ApartmentProvider
{
    private ApartmentRepository $apartmentRepository;

    public function __construct(ApartmentRepository $apartmentRepository)
    {
        $this->apartmentRepository = $apartmentRepository;
    }

    /**
     * Pobiera wszystkie mieszkania.
     *
     * @return Apartment[] Zwraca tablicę obiektów Apartment
     */
    public function getAllApartments(): array
    {
        return $this->apartmentRepository->findAll();
    }

    /**
     * Opcjonalnie: pobiera mieszkanie po ID
     *
     * @param int $id
     * @return Apartment|null
     */
    public function getApartmentById(int $id): ?Apartment
    {
        return $this->apartmentRepository->find($id);
    }
}

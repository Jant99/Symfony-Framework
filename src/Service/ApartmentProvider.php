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

    public function search(?int $maxPrice, ?int $rooms): array
{
    $qb = $this->apartmentRepository->createQueryBuilder('a');

    if ($maxPrice !== null) {
        $qb->andWhere('a.price <= :maxPrice')
           ->setParameter('maxPrice', $maxPrice);
    }

    if ($rooms !== null) {
        $qb->andWhere('a.rooms = :rooms')
           ->setParameter('rooms', $rooms);
    }

    $qb->orderBy('a.createdAt', 'DESC');

    return $qb->getQuery()->getResult();
}

/**
 * Zwraca ostatnio dodane mieszkanie
 */
public function getLastApartment(): ?Apartment
{
    return $this->apartmentRepository->createQueryBuilder('a')
        ->orderBy('a.createdAt', 'DESC')
        ->setMaxResults(1)
        ->getQuery()
        ->getOneOrNullResult();
}


}

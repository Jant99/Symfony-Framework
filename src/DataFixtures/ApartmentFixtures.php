<?php

namespace App\DataFixtures;

use App\Entity\Apartment;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;


class ApartmentFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $apartments = [
            [
                'title' => 'Kawalerka w centrum',
                'description' => 'Przytulna kawalerka blisko komunikacji miejskiej.',
                'price' => 2200.00,
                'rooms' => 1,
                'area' => 28,
                'address' => 'Warszawa, ul. Marszałkowska 10',
            ],
            [
                'title' => '2 pokoje na Mokotowie',
                'description' => 'Mieszkanie idealne dla pary lub singla.',
                'price' => 3200.00,
                'rooms' => 2,
                'area' => 45,
                'address' => 'Warszawa, ul. Puławska 120',
            ],
            [
                'title' => '3 pokoje z balkonem',
                'description' => 'Przestronne mieszkanie z dużym balkonem.',
                'price' => 4500.00,
                'rooms' => 3,
                'area' => 68,
                'address' => 'Warszawa, ul. Domaniewska 5',
            ],
        ];

        foreach ($apartments as $data) {
            $apartment = new Apartment();
            $apartment->setTitle($data['title']);
            $apartment->setDescription($data['description']);
            $apartment->setPrice($data['price']);
            $apartment->setRooms($data['rooms']);
            $apartment->setArea($data['area']);
            $apartment->setAddress($data['address']);
            $apartment->setCreatedAt(new \DateTimeImmutable());

            $manager->persist($apartment);
        }

        $manager->flush();
    }
}

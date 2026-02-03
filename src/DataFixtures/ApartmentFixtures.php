<?php

namespace App\DataFixtures;

use App\Entity\Apartment;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class ApartmentFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $apartments = [
            [
                'title' => 'Kawalerka w centrum',
                'description' => 'Przytulna kawalerka blisko komunikacji.',
                'price' => 2200,
                'rooms' => 1,
                'area' => 28,
                'address' => 'Warszawa, Marszałkowska 10',
                'category' => CategoryFixtures::CATEGORY_KAWALERKA,
            ],
            [
                'title' => '2 pokoje na Mokotowie',
                'description' => 'Idealne dla pary.',
                'price' => 3200,
                'rooms' => 2,
                'area' => 45,
                'address' => 'Warszawa, Puławska 120',
                'category' => CategoryFixtures::CATEGORY_TWO_ROOMS,
            ],
            [
                'title' => 'Apartament Premium',
                'description' => 'Luksusowe mieszkanie.',
                'price' => 5500,
                'rooms' => 3,
                'area' => 75,
                'address' => 'Warszawa, Złota 44',
                'category' => CategoryFixtures::CATEGORY_PREMIUM,
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

            /** @var \App\Entity\Category $category */
            $category = $this->getReference('category_kawalerka', \App\Entity\Category::class);
            $apartment->setCategory($category);


            $manager->persist($apartment);
        }

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            CategoryFixtures::class,
        ];
    }
}

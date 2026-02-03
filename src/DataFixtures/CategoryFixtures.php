<?php

namespace App\DataFixtures;

use App\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CategoryFixtures extends Fixture
{
    public const CATEGORY_KAWALERKA = 'category_kawalerka';
    public const CATEGORY_TWO_ROOMS = 'category_two_rooms';
    public const CATEGORY_PREMIUM = 'category_premium';

    public function load(ObjectManager $manager): void
    {
        $categories = [
            self::CATEGORY_KAWALERKA => 'Kawalerka',
            self::CATEGORY_TWO_ROOMS => '2 pokoje',
            self::CATEGORY_PREMIUM => 'Premium',
        ];

        foreach ($categories as $ref => $name) {
            $category = new Category();
            $category->setName($name);

            $manager->persist($category);
            $this->addReference($ref, $category);
        }

        $manager->flush();
    }
}

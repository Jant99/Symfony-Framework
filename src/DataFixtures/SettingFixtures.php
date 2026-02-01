<?php

namespace App\DataFixtures;

use App\Entity\Setting;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class SettingFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $settings = [
            ['key' => 'site_name', 'value' => 'Mój Serwis Mieszkaniowy'],
            ['key' => 'default_max_price', 'value' => '5000'],
        ];

        foreach ($settings as $s) {
            $setting = new Setting();
            $setting->setSettingKey($s['key']);
            $setting->setSettingValue($s['value']);
            $manager->persist($setting);
        }

        $manager->flush();
    }
}

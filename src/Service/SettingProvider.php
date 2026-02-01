<?php

namespace App\Service;

use App\Repository\SettingRepository;

class SettingProvider
{
    private SettingRepository $settingRepository;

    public function __construct(SettingRepository $settingRepository)
    {
        $this->settingRepository = $settingRepository;
    }

    /**
     * Pobiera wartość ustawienia po kluczu.
     * 
     * @param string $key Klucz ustawienia
     * @param string|null $default Wartość domyślna jeśli nie ma ustawienia
     * @return string|null
     */
    public function get(string $key, ?string $default = null): ?string
    {
        $setting = $this->settingRepository->findOneBy(['settingKey' => $key]);
        return $setting ? $setting->getSettingValue() : $default;
    }
}

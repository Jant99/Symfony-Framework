<?php

namespace App\Controller;

use App\Service\ApartmentProvider;
use App\Service\SettingProvider;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ApartmentController extends AbstractController
{
    private ApartmentProvider $apartmentProvider;
    private SettingProvider $settingProvider;
    // Wstrzyknięcie serwisu w konstruktorze
    public function __construct(ApartmentProvider $apartmentProvider, SettingProvider $settingProvider)
    {
        $this->apartmentProvider = $apartmentProvider;
        $this->settingProvider = $settingProvider;
    }

    #[Route('/', name: 'apartment_home', methods: ['GET'])]
    public function index(Request $request): Response
    {
        // Pobranie parametrów wyszukiwarki z query string
        $maxPrice = $request->query->getInt('maxPrice', 0);
        $rooms = $request->query->getInt('rooms', 0);

        $maxPriceFilter = $maxPrice > 0 ? $maxPrice : null;
        $roomsFilter    = $rooms > 0 ? $rooms : null;

        // Pobranie mieszkań zgodnie z filtrami
        $apartments = $this->apartmentProvider->search($maxPriceFilter, $roomsFilter);

        // Pobranie ostatniego mieszkania
        $lastApartment = $this->apartmentProvider->getLastApartment();

        // Pobranie ustawien
        $siteName = $this->settingProvider->get('site_name', 'Domyslna nazwa strona');
        
        return $this->render('apartment/index.html.twig', [
            
            'apartments' => $apartments,
            'lastApartment' => $lastApartment,
            'maxPrice' => $maxPrice,
            'rooms' => $rooms,
        ]);
    }

    

    
}


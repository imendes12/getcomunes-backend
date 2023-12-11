<?php

declare(strict_types=1);

namespace App\Controller\Business;

use App\Entity\Business;
use App\Entity\City;
use App\Helper\EntityManagerCreator;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class OpenBusinessController
{
    /**
     * @Route("/open/{cityId}/{businessId}")
     */
    public function openBusiness(int $cityId, int $businessId)
    {
        $entityManager = EntityManagerCreator::createEntityManager();

        $business = $entityManager->find(Business::class, $businessId);
        $city = $entityManager->find(City::class, $cityId);

        $city->openBusiness($business);

        $entityManager->flush();

        $response = [
            'resposta' => [
                'success'
            ],
        ];
        return new Response(json_encode($response));
    }
}

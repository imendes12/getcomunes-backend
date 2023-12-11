<?php

declare(strict_types=1);

namespace App\Controller\City;

use App\Entity\City;
use App\Helper\EntityManagerCreator;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ListCityController
{
    /**
     * @Route("/cities")
     */
    public function listCity()
    {
        $entityManager = EntityManagerCreator::createEntityManager();

        $repository = $entityManager->getRepository(City::class);

        $objects = $repository->findAll();

        $cities = [];

        foreach ($objects as $object) {
            $city = [];
            $city['id'] = $object->getId();
            $city['name'] = $object->getName();

            $city['business'] = array_map(function ($business) {
                return [
                    'id' => $business->getId(),
                    'name' => $business->getName(),
                ];
            }, $object->getBusiness()->toArray());

            $cities[] = $city;
        }

        $response = [
            'resposta' => $cities,
        ];
        return new Response(json_encode($response));
    }
}

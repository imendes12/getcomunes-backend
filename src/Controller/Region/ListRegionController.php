<?php

declare(strict_types=1);

namespace App\Controller\Region;

use App\Entity\Region;
use App\Helper\EntityManagerCreator;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ListRegionController
{
    /**
     * @Route("/regions")
     */
    public function listRegion()
    {
        $entityManager = EntityManagerCreator::createEntityManager();

        $regionRepository = $entityManager->getRepository(Region::class);

        $regions = array_map(function ($region) {
            return [
                'id' => $region->getId(),
                'name' => $region->getName(),
            ];
        }, $regionRepository->findAll());

        $response = [
            'resposta' => $regions,
        ];
        return new Response(json_encode($response));
    }
}

<?php

declare(strict_types=1);

namespace App\Controller\Region;

use App\Entity\Region;
use App\Helper\EntityManagerCreator;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CreateRegionController
{
    /**
     * @Route("/createregion")
     */
    public function createRegion()
    {
        $entityManager = EntityManagerCreator::createEntityManager();

        $region = new Region('centro-oeste');

        $entityManager->persist($region);
        $entityManager->flush();

        $response = [
            'resposta' => [
                'id' => $region->getId(),
                'name' => $region->getName(),
            ],
        ];
        return new Response(json_encode($response));
    }
}
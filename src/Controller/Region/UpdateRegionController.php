<?php

declare(strict_types=1);

namespace App\Controller\Region;

use App\Entity\Region;
use App\Helper\EntityManagerCreator;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UpdateRegionController
{
    /**
     * @Route("/updateregion/{id}")
     */
    public function updateRegion(int $id)
    {
        $entityManager = EntityManagerCreator::createEntityManager();

        $region = $entityManager->find(Region::class, $id);

        $region->setName('sul');

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

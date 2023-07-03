<?php

declare(strict_types=1);

namespace App\Controller\Region;

use App\Entity\Region;
use App\Helper\EntityManagerCreator;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class GetRegionController
{
    /**
     * @Route("/regions/{id}")
     */
    public function getRegion(int $id)
    {
        $entityManager = EntityManagerCreator::createEntityManager();

        $regionRepository = $entityManager->getRepository(Region::class);

        $region = $regionRepository->find($id);

        $response = [
            'resposta' => [
                'id' => $region->getId(),
                'name' => $region->getName(),
            ],
        ];
        return new Response(json_encode($response));
    }
}

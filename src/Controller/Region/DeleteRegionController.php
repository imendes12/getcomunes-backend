<?php

declare(strict_types=1);

namespace App\Controller\Region;

use App\Entity\Region;
use App\Helper\EntityManagerCreator;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DeleteRegionController
{
    /**
     * @Route("/deleteregion/{id}")
     */
    public function deleteRegion(int $id)
    {
        $entityManager = EntityManagerCreator::createEntityManager();

        $region = $entityManager->getPartialReference(Region::class, $id);

        $entityManager->remove($region);
        $entityManager->flush();

        $response = [
            'resposta' => 'success',
        ];
        return new Response(json_encode($response));
    }
}

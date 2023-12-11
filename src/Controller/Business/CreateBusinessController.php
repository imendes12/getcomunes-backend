<?php

declare(strict_types=1);

namespace App\Controller\Business;

use App\Entity\Business;
use App\Helper\EntityManagerCreator;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CreateBusinessController
{
    /**
     * @Route("/createbusiness/")
     */
    public function createBusiness()
    {
        $entityManager = EntityManagerCreator::createEntityManager();

        $leleo = new Business('Leleo');
        $granjeiro = new Business('Granjeiro');

        $entityManager->persist($leleo);
        $entityManager->persist($granjeiro);
        $entityManager->flush();

        $response = [
            'resposta' => [
                [
                    'id' => $leleo->getId(),
                    'name' => $leleo->getName(),
                ],
                [
                    'id' => $granjeiro->getId(),
                    'name' => $granjeiro->getName(),
                ],
            ],
        ];
        return new Response(json_encode($response));
    }
}

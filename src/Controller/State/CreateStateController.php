<?php

declare(strict_types=1);

namespace App\Controller\State;

use App\Entity\Region;
use App\Entity\State;
use App\Helper\EntityManagerCreator;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CreateStateController
{
    /**
     * @Route("/createstate")
     */
    public function createState()
    {
        $entityManager = EntityManagerCreator::createEntityManager();

        $region = new Region('Nordeste');
        $region->addState(new State('Alagoas'));
        $region->addState(new State('Bahia'));
        $region->addState(new State('Ceará'));
        $region->addState(new State('Maranhão'));
        $region->addState(new State('Paraíba'));
        $region->addState(new State('Pernambuco'));
        $region->addState(new State('Piauí'));
        $region->addState(new State('Rio Grande do Norte'));
        $region->addState(new State('Sergipe'));

        $entityManager->persist($region);
        $entityManager->flush();

        $response = [
            'resposta' => [
                'id' => $region->getId(),
                'name' => $region->getName(),
                'state' => $region->getStates()->toArray(),
            ],
        ];
        return new Response(json_encode($response));
    }
}
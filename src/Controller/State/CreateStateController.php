<?php

declare(strict_types=1);

namespace App\Controller\State;

use App\Entity\City;
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

        $ceara = new State('Ceará');
        $region->addState($ceara);
        $region->addState(new State('Maranhão'));
        $region->addState(new State('Paraíba'));
        $region->addState(new State('Pernambuco'));
        $region->addState(new State('Piauí'));
        $region->addState(new State('Rio Grande do Norte'));
        $region->addState(new State('Sergipe'));

        $fortaleza = new City('Fortaleza');
        $fortaleza->setState($ceara);
        
        $russas = new City('Russas');
        $russas->setState($ceara);

        $juazeiro = new City('Juazeiro');
        $juazeiro->setState($ceara);

        $entityManager->persist($region);
        $entityManager->persist($fortaleza);
        $entityManager->persist($russas);
        $entityManager->persist($juazeiro);
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
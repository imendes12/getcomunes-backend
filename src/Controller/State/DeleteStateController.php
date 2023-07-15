<?php

declare(strict_types=1);

namespace App\Controller\State;

use App\Entity\State;
use App\Helper\EntityManagerCreator;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DeleteStateController
{
    /**
     * @Route("/deletestate/{id}")
     */
    public function deleteState(int $id)
    {
        $entityManager = EntityManagerCreator::createEntityManager();

        $state = $entityManager->find(State::class, $id);

        $entityManager->remove($state);
        $entityManager->flush();

        $response = [
            'resposta' => 'success',
        ];
        return new Response(json_encode($response));
    }
}

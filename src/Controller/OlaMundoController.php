<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class OlaMundoController
{
    /**
     * @Route("/ola")
     */
    public function olaMundoAction()
    {
        $response = [
            'resposta' => 'hellow world',
        ];
        return new Response(json_encode($response));
    }
}

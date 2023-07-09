<?php

namespace tests\Functional;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\Routing\Annotation\Route;

class OlaTest extends WebTestCase
{
    /**
     * @Route("/createregion")
     */
    public function testCreate()
    {
        $client = static::createClient();

        $client->request('GET', '/createregion');

        $this->assertTrue($client->getResponse()->isSuccessful());

        $json = json_encode([
            'resposta' => [
                'id' => 1,
                'name' => 'centro-oeste',
            ],
        ]);

        $response = $client->getResponse()->getContent();
        $this->assertStringContainsString($json, $response);
    }
}

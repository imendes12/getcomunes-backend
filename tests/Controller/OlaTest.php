<?php

namespace tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\Routing\Annotation\Route;

class OlaTest extends WebTestCase
{
    /**
     * @Route("/ola")
     */
    public function testAnnotation()
    {
        $client = static::createClient();

        $client->request('GET', '/ola');

        $this->assertTrue($client->getResponse()->isSuccessful());
    }
}

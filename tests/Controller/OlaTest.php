<?php

namespace tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\Routing\Annotation\Route;

class OlaTest extends WebTestCase
{
    /**
     * @Route("/ola")
     */
    public function testOla()
    {
        $client = static::createClient();

        $client->request('GET', '/ola');

        $this->assertTrue($client->getResponse()->isSuccessful());
    }

    /**
     * @Route("/ola")
     */
    public function testHello()
    {
        $client = static::createClient();

        $client->request('GET', '/ola');

        $response = $client->getResponse()->getContent();
        $this->assertStringContainsString('hellow world', $response);
    }
}

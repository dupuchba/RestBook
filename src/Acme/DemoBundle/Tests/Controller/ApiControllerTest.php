<?php

namespace Acme\DemoBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ApiControllerTest extends WebTestCase
{
    public function testGetusers()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/api/users');
    }

    public function testGetuser()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/api/users/{id}');
    }

    public function testNewuser()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/api/users');
    }

    public function testEdituser()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/api/users/{id}');
    }

    public function testDeleteuser()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/api/users/{id}');
    }

}

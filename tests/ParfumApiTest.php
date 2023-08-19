<?php

namespace App\Tests;

use App\Repository\Database;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ParfumApiTest extends WebTestCase
{
    public function setUp(): void
    {
        Database::getConnection()->query(file_get_contents(__DIR__ . '/../database.sql'));
    }
    public function testGetAll(): void
    {
        $client = static::createClient();
        $client->request('GET', '/api/shop');
        $json = json_decode($client->getResponse()->getContent(), true);

        $this->assertResponseIsSuccessful();
        $this->assertNotEmpty($json);
        $this->assertIsString($json[0]['name']);
        $this->assertIsString($json[0]['address']);
        $this->assertIsInt($json[0]['id']);

    }

    public function testGetAllSuccess(): void
    {
        $client = static::createClient();
        $client->request('GET', '/api/shop');
        $json = json_decode($client->getResponse()->getContent(), true);
        $this->assertResponseIsSuccessful();
        $this->assertNotEmpty($json);
        $this->assertIsString($json[0]['name']);
        $this->assertIsInt($json[0]['id']);

    }

    public function testGetOneSuccess(): void
    {
        $client = static::createClient();
        $client->request('GET', '/api/shop/1');
        $json = json_decode($client->getResponse()->getContent(), true);
        $this->assertResponseIsSuccessful();
        $this->assertNotEmpty($json);
        $this->assertIsString($json['name']);
        $this->assertIsString($json['address']);
        $this->assertIsInt($json['id']);

    }

    public function testGetOneNotFound(): void
    {
        $client = static::createClient();
        $client->request('GET', '/api/shop/100');
        $json = json_decode($client->getResponse()->getContent(), true);
        $this->assertResponseStatusCodeSame(404);
    }

    public function testPostSuccess(): void
    {
        $client = static::createClient();
        $client->request('POST', '/api/shop', content: json_encode([
            'name' => 'L\'odeurs',
            'address' => 'rue M2I',
        ]));
        $json = json_decode($client->getResponse()->getContent(), true);
        $this->assertResponseIsSuccessful();

        $this->assertIsInt($json['id']);

    }

    public function testPatchSuccess(): void
    {
        $client = static::createClient();
        $client->request('PATCH', '/api/shop/1', content: json_encode([
            'address' => 'rue Nisreen',

        ]));
        $json = json_decode($client->getResponse()->getContent(), true);
        $this->assertResponseIsSuccessful();

        $this->assertEquals($json['name'], 'NNCM');
    }

    public function testPostValidationFailed(): void
    {
        $client = static::createClient();
        $client->request('POST', '/api/shop', content: json_encode([
            'name' => '',
            'address' => '',
            
        ]));
        $json = json_decode($client->getResponse()->getContent(), true);

        $this->assertResponseStatusCodeSame(400);

        $this->assertStringContainsString('name', $json['errors']['detail']);
        $this->assertStringContainsString('address', $json['errors']['detail']);
    }

    public function testPatchNotFound(): void
    {
        $client = static::createClient();
        $client->request('PATCH', '/api/shop/100');
        $this->assertResponseStatusCodeSame(404);


    }
    public function testDeleteSuccess(): void
    {
        $client = static::createClient();
        $client->request('DELETE', '/api/shop/1');
        $this->assertResponseIsSuccessful();
    }

}
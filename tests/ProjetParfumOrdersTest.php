<?php

namespace App\Tests;

use App\Repository\Database;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ProjetParfumOrdersTest extends WebTestCase
{

    public function setUp(): void
    {
        Database::getConnection()->query(file_get_contents(__DIR__ . '/../database.sql'));
    }
    public function testGetAll(): void
    {
        $client = static::createClient();
        $client->request('GET', '/api/orders');
        $json = json_decode($client->getResponse()->getContent(), true);

        $this->assertResponseIsSuccessful();
        $this->assertNotEmpty($json);
        $this->assertIsString($json[0]['createdAt']);
        $this->assertIsString($json[0]['customerName']);
        $this->assertIsInt($json[0]['id']);

    }

    public function testGetAllSuccess(): void
    {
        $client = static::createClient();
        $client->request('GET', '/api/orders');
        $json = json_decode($client->getResponse()->getContent(), true);
        $this->assertResponseIsSuccessful();
        $this->assertNotEmpty($json);
        $this->assertIsString($json[0]['createdAt']);
        $this->assertIsString($json[0]['customerName']);
        $this->assertIsInt($json[0]['id']);

    }

    public function testGetOneSuccess(): void
    {
        $client = static::createClient();
        $client->request('GET', '/api/orders/1');
        $json = json_decode($client->getResponse()->getContent(), true);
        $this->assertResponseIsSuccessful();
        $this->assertNotEmpty($json);
        $this->assertIsString($json['createdAt']);
        $this->assertIsString($json['customerName']);
        $this->assertIsInt($json['id']);

    }



    public function testGetOneNotFound(): void
    {
        $client = static::createClient();
        $client->request('GET', '/api/orders/100');
        $json = json_decode($client->getResponse()->getContent(), true);
        $this->assertResponseStatusCodeSame(404);
    }



    public function testPostSuccess(): void
    {
        $client = static::createClient();
        $client->request('POST', '/api/orders', content: json_encode([
            'createdAt' => '1998-05-14',
            'customerName'=>'Nesrine'

        ]));
        $json = json_decode($client->getResponse()->getContent(), true);
        $this->assertResponseIsSuccessful();

        $this->assertIsInt($json['id']);
    }

    public function testPatchSuccess(): void
    {
        $client = static::createClient();
        $client->request('PATCH', '/api/orders/1', content: json_encode([
            'customerName' => 'Nisreen',
        ]));
        $json = json_decode($client->getResponse()->getContent(), true);
        $this->assertResponseIsSuccessful();


    }

    public function testPostValidationFailed(): void
    {
        $client = static::createClient();
        $client->request('POST', '/api/orders', content: json_encode([
            'createdAt' => '2023-07-07',
            'customerName' =>''
        ]));
        $json = json_decode($client->getResponse()->getContent(), true);

        $this->assertResponseStatusCodeSame(400);

        $this->assertStringContainsString('customerName', $json['errors']['detail']);

    }
    public function testPatchNotFound(): void
    {
        $client = static::createClient();
        $client->request('PATCH', '/api/orders/100');
        $this->assertResponseStatusCodeSame(404);


    }
    public function testDeleteSuccess(): void
    {
        $client = static::createClient();
        $client->request('DELETE', '/api/orders/1');
        $this->assertResponseIsSuccessful();

    }
}
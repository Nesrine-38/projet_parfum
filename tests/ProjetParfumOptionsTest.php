<?php

namespace App\Tests;

use App\Repository\Database;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ProjetParfumOptionsTest extends WebTestCase
{
    public function setUp(): void
    {
        Database::getConnection()->query(file_get_contents(__DIR__ . '/../database.sql'));
    }
    public function testGetAll(): void
    {
        $client = static::createClient();
        $client->request('GET', '/api/options');
        $json = json_decode($client->getResponse()->getContent(), true);

        $this->assertResponseIsSuccessful();
        $this->assertNotEmpty($json);
        $this->assertIsString($json[0]['label']);
        $this->assertIsFloat($json[0]['price']);
        $this->assertIsInt($json[0]['idProduct']);
        $this->assertIsInt($json[0]['id']);

    }

    public function testGetAllSuccess(): void
    {
        $client = static::createClient();
        $client->request('GET', '/api/options');
        $json = json_decode($client->getResponse()->getContent(), true);
        $this->assertResponseIsSuccessful();
        $this->assertNotEmpty($json);
        $this->assertIsString($json[0]['label']);
        $this->assertIsFloat($json[0]['price']);
        $this->assertIsInt($json[0]['idProduct']);
        $this->assertIsInt($json[0]['id']);

    }

    public function testGetOneSuccess(): void
    {
        $client = static::createClient();
        $client->request('GET', '/api/options/1');
        $json = json_decode($client->getResponse()->getContent(), true);
        $this->assertResponseIsSuccessful();
        $this->assertNotEmpty($json);
        $this->assertIsString($json['label']);
        $this->assertIsFloat($json['price']);
        $this->assertIsInt($json['idProduct']);
        $this->assertIsInt($json['id']);

    }



    public function testGetOneNotFound(): void
    {
        $client = static::createClient();
        $client->request('GET', '/api/options/100');
        $json = json_decode($client->getResponse()->getContent(), true);
        $this->assertResponseStatusCodeSame(404);
    }



    public function testPostSuccess(): void
    {
        $client = static::createClient();
        $client->request('POST', '/api/options', content: json_encode([
            'label' => 'test',
            'price' => 68.99,
            'idProduct' => 1
        ]));
        $json = json_decode($client->getResponse()->getContent(), true);
        $this->assertResponseIsSuccessful();
        $this->assertIsInt($json['id']);
    }

    public function testPatchSuccess(): void
    {
        $client = static::createClient();
        $client->request('PATCH', '/api/options/1', content: json_encode([
            'price' => 3,
        ]));
        $json = json_decode($client->getResponse()->getContent(), true);
        $this->assertResponseIsSuccessful();
    }

    public function testPostValidationFailed(): void
    {
        $client = static::createClient();
        $client->request('POST', '/api/options', content: json_encode([
            'label' => '',
            'price' => 68.99,
            'idProduct' => 1
        ]));
        $json = json_decode($client->getResponse()->getContent(), true);

        $this->assertResponseStatusCodeSame(400);

        $this->assertStringContainsString('label', $json['errors']['detail']);

    }
    public function testPatchNotFound(): void
    {
        $client = static::createClient();
        $client->request('PATCH', '/api/options/100');
        $this->assertResponseStatusCodeSame(404);


    }
    public function testDeleteSuccess(): void
    {
        $client = static::createClient();
        $client->request('DELETE', '/api/options/1');
        $this->assertResponseIsSuccessful();

    }
}

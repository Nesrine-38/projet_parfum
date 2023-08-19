<?php

namespace App\Tests;

use App\Repository\Database;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ProjetParfumProductTest extends WebTestCase
{
 
    public function setUp(): void
    {
        Database::getConnection()->query(file_get_contents(__DIR__ . '/../database.sql'));
    }
    public function testGetAll(): void
    {
        $client = static::createClient();
        $client->request('GET', '/api/product');
        $json = json_decode($client->getResponse()->getContent(), true);

        $this->assertResponseIsSuccessful();
        $this->assertNotEmpty($json);
        $this->assertIsString($json[0]['label']);
        $this->assertIsFloat($json[0]['basePrice']);
        $this->assertIsString($json[0]['description']);
        $this->assertIsString($json[0]['picture']);
        $this->assertIsInt($json[0]['idShop']);
        $this->assertIsInt($json[0]['id']);

    }

    public function testGetAllSuccess(): void
    {
        $client = static::createClient();
        $client->request('GET', '/api/product');
        $json = json_decode($client->getResponse()->getContent(), true);
        $this->assertResponseIsSuccessful();
        $this->assertNotEmpty($json);
        $this->assertIsString($json[0]['label']);
        $this->assertIsFloat($json[0]['basePrice']);
        $this->assertIsString($json[0]['description']);
        $this->assertIsString($json[0]['picture']);
        $this->assertIsInt($json[0]['idShop']);
        $this->assertIsInt($json[0]['id']);

    }

    public function testGetOneSuccess(): void
    {
        $client = static::createClient();
        $client->request('GET', '/api/product/1');
        $json = json_decode($client->getResponse()->getContent(), true);
        $this->assertResponseIsSuccessful();
        $this->assertNotEmpty($json);
        $this->assertIsString($json['label']);
        $this->assertIsFloat($json['basePrice']);
        $this->assertIsString($json['description']);
        $this->assertIsString($json['picture']);
        $this->assertIsInt($json['idShop']);
        $this->assertIsInt($json['id']);

    }



    public function testGetOneNotFound(): void
    {
        $client = static::createClient();
        $client->request('GET', '/api/product/100');
        $json = json_decode($client->getResponse()->getContent(), true);
        $this->assertResponseStatusCodeSame(404);
    }



    public function testPostSuccess(): void
    {
        $client = static::createClient();
        $client->request('POST', '/api/product', content: json_encode([
            'label' => 'test',
            'basePrice' => 60.99,
            'description' => 'rue test',
            'picture' => 'test',
            'idShop' => 1
        ]));
        $json = json_decode($client->getResponse()->getContent(), true);
        $this->assertResponseIsSuccessful();

        $this->assertIsInt($json['id']);
    }

    public function testPatchSuccess(): void
    {
        $client = static::createClient();
        $client->request('PATCH', '/api/product/2', content: json_encode([
            'basePrice' => 70.00,
        ]));
        $json = json_decode($client->getResponse()->getContent(), true);
        $this->assertResponseIsSuccessful();


    }

    public function testPostValidationFailed(): void
    {
        $client = static::createClient();
        $client->request('POST', '/api/product', content: json_encode([
            'label' => '',
            'basePrice' => 60.99,
            'description' => 'rue test',
            'picture' => 'test',
            'idShop' => 2
        ]));
        $json = json_decode($client->getResponse()->getContent(), true);

        $this->assertResponseStatusCodeSame(400);

        $this->assertStringContainsString('label', $json['errors']['detail']);

    }
    public function testPatchNotFound(): void
    {
        $client = static::createClient();
        $client->request('PATCH', '/api/product/100');
        $this->assertResponseStatusCodeSame(404);


    }
    public function testDeleteSuccess(): void
    {
        $client = static::createClient();
        $client->request('DELETE', '/api/product/3');
        $this->assertResponseIsSuccessful();

    }
}
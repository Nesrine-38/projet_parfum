<?php

namespace App\Tests;

use App\Repository\Database;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ProjetParfumOrderItemTest extends WebTestCase
{public function setUp(): void
    {
        Database::getConnection()->query(file_get_contents(__DIR__ . '/../database.sql'));
    }
    public function testGetAll(): void
    {
        $client = static::createClient();
        $client->request('GET', '/api/orderitem');
        $json = json_decode($client->getResponse()->getContent(), true);

        $this->assertResponseIsSuccessful();
        $this->assertNotEmpty($json);
        $this->assertIsInt($json[0]['quantity']);
        $this->assertIsFloat($json[0]['itemPrice']);
        $this->assertIsInt($json[0]['idProduct']);
        $this->assertIsInt($json[0]['idOrder']);
        $this->assertIsInt($json[0]['id']);

    }

    public function testGetAllSuccess(): void
    {
        $client = static::createClient();
        $client->request('GET', '/api/orderitem');
        $json = json_decode($client->getResponse()->getContent(), true);
        $this->assertResponseIsSuccessful();
        $this->assertNotEmpty($json);
        $this->assertIsInt($json[0]['quantity']);
        $this->assertIsFloat($json[0]['itemPrice']);
        $this->assertIsInt($json[0]['idProduct']);
        $this->assertIsInt($json[0]['idOrder']);
        $this->assertIsInt($json[0]['id']);

    }

    public function testGetOneSuccess(): void
    {
        $client = static::createClient();
        $client->request('GET', '/api/orderitem/1');
        $json = json_decode($client->getResponse()->getContent(), true);
        $this->assertResponseIsSuccessful();
        $this->assertNotEmpty($json);
        $this->assertIsInt($json['quantity']);
        $this->assertIsFloat($json['itemPrice']);
        $this->assertIsInt($json['idProduct']);
        $this->assertIsInt($json['idOrder']);
        $this->assertIsInt($json['id']);

    }



    public function testGetOneNotFound(): void
    {
        $client = static::createClient();
        $client->request('GET', '/api/orderitem/100');
        $json = json_decode($client->getResponse()->getContent(), true);
        $this->assertResponseStatusCodeSame(404);
    }



    public function testPostSuccess(): void
    {
        $client = static::createClient();
        $client->request('POST', '/api/orderitem', content: json_encode([
            'quantity' => 12,
            'itemPrice' => 68.99,
            'idProduct' => 1,
            'idOrder' => 1
        ]));
        $json = json_decode($client->getResponse()->getContent(), true);
        $this->assertResponseIsSuccessful();

        $this->assertIsInt($json['id']);
    }

    public function testPatchSuccess(): void
    {
        $client = static::createClient();
        $client->request('PATCH', '/api/orderitem/1', content: json_encode([
            'quantity' => 3,
        ]));
        $json = json_decode($client->getResponse()->getContent(), true);
        $this->assertResponseIsSuccessful();

    }

    public function testPostValidationFailed(): void
    {
        $client = static::createClient();
        $client->request('POST', '/api/orderitem', content: json_encode([
            'quantity' => -12,
            'itemPrice' => 68.99,
            'idOrders' => 1,
            'idProduct' => 1

        ]));
        $json = json_decode($client->getResponse()->getContent(), true);

        $this->assertResponseStatusCodeSame(400);

    }
    public function testPatchNotFound(): void
    {
        $client = static::createClient();
        $client->request('PATCH', '/api/orderitem/100');
        $this->assertResponseStatusCodeSame(404);


    }
    public function testDeleteSuccess(): void
    {
        $client = static::createClient();
        $client->request('DELETE', '/api/orderitem/1');
        $this->assertResponseIsSuccessful();

    }
}
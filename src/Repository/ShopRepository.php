<?php

namespace App\Repository;
use App\Entity\Product;
use App\Entity\Shop;

class ShopRepository
{

    /**
     * @return Shop[] 
     */
    public function findAll(): array
    {
        $list = [];
        $connection = Database::getConnection();
        $query = $connection->prepare ("SELECT * FROM shop");
        $query->execute();
        foreach ($query->fetchAll() as $line) {
            $list[] = new Shop($line["name"], $line["address"],$line["id"]);
        }
        return $list;
    }

    public function findById(int $id): ?Shop
    {

        $connection = Database::getConnection();
        $query = $connection->prepare("SELECT * FROM shop WHERE id=:id ");
        $query->bindValue(":id", $id);
        $query->execute();

        foreach ($query->fetchAll() as $line) {
            return new Shop($line["name"], $line["address"],$line["id"]);
        }
        return null;

    }
    /**
     * @return Shop[]
     */
    public function findByProduct(int $id): array
    {
        $list = [];
        $connection = Database::getConnection();
        $query = $connection->prepare("SELECT*FROM product
        LEFT JOIN shop ON product.id_shop=shop.id
        WHERE product.id_shop=:id");
        $query->bindValue(':id', $id);
        $query->execute();
        foreach ($query->fetchAll() as $line) {
            $list[] = new Shop( $line["name"], $line["address"],$line["id"]);
        }

        return $list;
    }
    /**
     * @param $shop
     */
    public function persist(Shop $shop)
    {
        $connection = Database::getConnection();
        $query = $connection->prepare("INSERT INTO shop (name, address) VALUES (:name, :address)");
        $query->bindValue(':name', $shop->getName());
        $query->bindValue(':address', $shop->getAddress());
        $query->execute();

        $shop->setId($connection->lastInsertId());
    }

    /**
     * @param $id
     */
    public function delete(int $id)
    {

        $connection = Database::getConnection();

        $query = $connection->prepare("DELETE FROM shop WHERE id=:id");
        $query->bindValue(":id", $id);
        $query->execute();
    }



    /**
     * @param Shop $shop
     */
    public function update(Shop $shop)
    {

        $connection = Database::getConnection();
        $query = $connection->prepare("UPDATE shop SET name=:name, address=:address WHERE id=:id");
        $query->bindValue(':name', $shop->getName());
        $query->bindValue(':address', $shop->getAddress());
        $query->bindValue(":id", $shop->getId());

        $query->execute();
    }
    public function findByShop(int $id): array
    {
        $list = [];
        $connection = Database::getConnection();
        $query = $connection->prepare("SELECT * FROM product
        where id_shop=:id");
         $query->bindValue(':id', $id);
        $query->execute();
        foreach ($query->fetchAll() as $line) {
            $list[] = new Product($line["label"], $line["basePrice"], $line["description"], $line["picture"], $line["id_shop"], $line["id"]);
        }
        return $list;
    }
}
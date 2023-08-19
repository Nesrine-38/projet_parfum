<?php

namespace App\Repository;
use App\Entity\Product;
use App\Entity\shop;
class ProductRepository
{

    /**
     * @return Product[] 
     */
    public function findAll(): array
    {
        $list = [];
        $connection = Database::getConnection();
        $query = $connection->prepare("SELECT * FROM product");
        $query->execute();
        foreach ($query->fetchAll() as $line) {
            $list[] = new Product($line["label"], $line["basePrice"], $line["description"], $line["picture"], $line["id_shop"], $line["id"]);
        }
        return $list;
    }



    public function findById(int $id): ?Product
    {

        $connection = Database::getConnection();
        $query = $connection->prepare("SELECT * FROM product
        WHERE product.id=:id");
        $query->bindValue(':id', $id);
        $query->execute();
        foreach ($query->fetchAll() as $line) {
            return new Product($line["label"], $line["basePrice"], $line["description"], $line["picture"], $line["id_shop"], $line["id"]);
        }
        return null;

    }



    /**
     * @param $product
     */
    public function persist(Product $product)
    {
        $connection = Database::getConnection();
        $query = $connection->prepare("INSERT INTO product (label,basePrice,description,picture,id_shop,id) VALUES (:label, :basePrice,:description,:picture,:id_shop,:id)");
        $query->bindValue(':label', $product->getLabel());
        $query->bindValue(':basePrice', $product->getBasePrice());
        $query->bindValue(':description', $product->getDescription());
        $query->bindValue(':picture', $product->getPicture());
        $query->bindValue(':id_shop', $product->getIdShop());
        $query->bindValue(':id', $product->getId());
        $query->execute();

        $product->setId($connection->lastInsertId());
    }

    /**
     * @param $id
     */
    public function delete(int $id)
    {

        $connection = Database::getConnection();

        $query = $connection->prepare("DELETE FROM product WHERE id=:id");
        $query->bindValue(":id", $id);
        $query->execute();
    }



    /**
     * @param Product $product
     */
    public function update(Product $product)
    {

        $connection = Database::getConnection();
        $query = $connection->prepare("UPDATE product SET label=:label, basePrice=:basePrice,description=:description,picture=:picture,id_shop=:id_shop WHERE id=:id");
        $query->bindValue(':label', $product->getLabel());
        $query->bindValue(':basePrice', $product->getBasePrice());
        $query->bindValue(':description', $product->getDescription());
        $query->bindValue(':picture', $product->getPicture());
        $query->bindValue(':id_shop', $product->getIdShop());
        $query->bindValue(":id", $product->getId());

        $query->execute();
    }
}
<?php

namespace App\Repository;
use App\Entity\Options;



class OptionsRepository
{

    /**
     * @return Options[] 
     */
    public function findAll(): array
    {
        $list = [];
        $connection = Database::getConnection();
        $query = $connection->prepare("SELECT * FROM options");
        $query->execute();
        foreach ($query->fetchAll() as $line) {
            $list[] = new Options($line["label"], $line["price"], $line["id_product"],$line["id"]);
        }
        return $list;
    }



    
     public function findById(int $id): ?Options
     {
 
         $connection = Database::getConnection();
         $query = $connection->prepare("SELECT * FROM options
         WHERE options.id=:id");
         $query->bindValue(':id', $id);
         $query->execute();
         foreach ($query->fetchAll() as $line) {
             return new Options($line["label"], $line["price"], $line["id_product"],$line["id"]);
         }
         return null;
 
     }


    /**
     * @param $options
     */
    public function persist(Options $options)
    {
        $connection = Database::getConnection();
        $query = $connection->prepare("INSERT INTO options (label,price,id_product) VALUES (:label, :price,:id_product)");
        $query->bindValue(':label', $options->getLabel());
        $query->bindValue(':price', $options->getPrice());
        $query->bindValue(':id_product', $options->getIdProduct());
        $query->execute();

        $options->setId($connection->lastInsertId());
    }

    /**
     * @param $id
     */
    public function delete(int $id)
    {

        $connection = Database::getConnection();

        $query = $connection->prepare("DELETE FROM options WHERE id=:id");
        $query->bindValue(":id", $id);
        $query->execute();
    }



    /**
     * @param Options $options
     */
    public function update(Options $options)
    {

        $connection = Database::getConnection();
        $query = $connection->prepare("UPDATE options SET label=:label, price=:price,id_product=:id_product WHERE id=:id");
        $query->bindValue(':label', $options->getLabel());
        $query->bindValue(':price', $options->getPrice());
        $query->bindValue(':id_product', $options->getIdProduct());
        $query->bindValue(":id", $options->getId());

        $query->execute();
    }
}
<?php

namespace App\Repository;

use App\Entity\OrderItem;



class OrderItemRepository
{
    /**
     * @return OrderItem[] 
     */
    public function findAll(): array
    {
        $list = [];
        $connection = Database::getConnection();
        $query = $connection->prepare("SELECT * FROM orderitem");
        $query->execute();
        foreach ($query->fetchAll() as $line) {
            $list[] = new OrderItem($line["quantity"], $line["itemPrice"], $line["id_product"], $line["id_orders"], $line["id"]);
        }
        return $list;
    }

    public function findById(int $id): ?OrderItem
    {

        $connection = Database::getConnection();
        $query = $connection->prepare("SELECT * FROM orderitem
        WHERE orderitem.id=:id");
        $query->bindValue(':id', $id);
        $query->execute();
        foreach ($query->fetchAll() as $line) {
            return new OrderItem($line["quantity"], $line["itemPrice"],$line["id_orders"] ,$line["id_product"], $line["id"]);
        }
        return null;

    }


    /**
     * @return OrderItem[]
     */
    public function findByOrder(int $id): array
    {
        $list = [];
        $connection = Database::getConnection();
        $query = $connection->prepare("SELECT *FROM orderitem
            LEFT JOIN product ON product.id = orderitem.id_product
            LEFT JOIN options_orderitem ON options_orderitem.id_orderitem = orderitem.id
            LEFT JOIN options ON options.id = options_orderitem.id_options
        WHERE orderitem.id_orders = :id");
        $query->bindValue(':id', $id);
        $query->execute();
        foreach ($query->fetchAll() as $line) {
            $list[] = new OrderItem($line["quantity"], $line["itemPrice"], $line["id_orders"], $line["id_product"], $line["id"]);
        }

        return $list;
    }



    /**
     * @param $orders
     */
    public function persist(OrderItem $orderItem)
    {
        $connection = Database::getConnection();
        $query = $connection->prepare("INSERT INTO orderitem (quantity, itemPrice, id_orders, id_product) VALUES (:quantity, :itemPrice, :id_orders, :id_product)");
        $query->bindValue(':quantity', $orderItem->getQuantity());
        $query->bindValue(':itemPrice', $orderItem->getItemPrice());
        $query->bindValue(':id_orders', $orderItem->getIdOrder());
        $query->bindValue(':id_product', $orderItem->getIdProduct());

        $query->execute();

        $orderItem->setId($connection->lastInsertId());
    }

    /**
     * @param $id
     */
    public function delete(int $id)
    {
        $connection = Database::getConnection();

        $query = $connection->prepare("DELETE FROM orderitem WHERE id=:id");
        $query->bindValue(":id", $id);
        $query->execute();
    }



     /**
     * @param OrderItem $OrderItem
     */
    public function update(OrderItem $OrderItem)
    {

        $connection = Database::getConnection();
        $query = $connection->prepare("UPDATE orderitem SET quantity=:quantity,itemPrice=:itemPrice, id_orders=:id_orders, id_product=:id_product WHERE id=:id");
        $query->bindValue(':quantity', $OrderItem->getQuantity());
        $query->bindValue(':itemPrice', $OrderItem->getItemPrice());
        $query->bindValue(':id_orders', $OrderItem->getIdOrder());
        $query->bindValue(':id_product', $OrderItem->getIdProduct());
        $query->bindValue(":id", $OrderItem->getId());
        $query->execute();
    }
}
<?php

namespace App\Repository;
use App\Entity\Orders;


class OrdersRepository
{

    /**
     * @return Orders[] 
     */
    public function findAll(): array
    {
        $list = [];
        $connection = Database::getConnection();
        $query = $connection->prepare("SELECT * FROM orders");
        $query->execute();
        foreach ($query->fetchAll() as $line) {
            $list[] = new Orders(new \DateTime ($line["createdAt"]), $line["customerName"],$line["id"]);
        }
        return $list;
    }


    public function findById(int $id): ?Orders
    {

        $connection = Database::getConnection();
        $query = $connection->prepare("SELECT * FROM orders
        WHERE orders.id=:id");
        $query->bindValue(':id', $id);
        $query->execute();
        foreach ($query->fetchAll() as $line) {
            return new Orders(new \DateTime ($line["createdAt"]), $line["customerName"],$line["id"]);
        }
        return null;

    }


    /**
     * @return Orders[]
     */
    public function findByOrdersItem(int $id): array
    {
        $list = [];
        $connection = Database::getConnection();
        $query = $connection->prepare("SELECT * FROM orders
        LEFT JOIN orderItem ON orderItem.id_orders=orders.id
        WHERE orderItem.id_orders =:id");
        $query->bindValue(':id', $id);
        $query->execute();
        foreach ($query->fetchAll() as $line) {
            $list[] = new Orders(new \DateTime ($line["createdAt"]), $line["customerName"],$line["id"]);
        }

        return $list;
    }



    /**
     * @param $orders
     */
    public function persist(Orders $orders)
    {
        $connection = Database::getConnection();
        $query = $connection->prepare("INSERT INTO orders (createdAt,customerName) VALUES (:createdAt, :customerName)");
        $query->bindValue(':createdAt', $orders->getCreatedAt()->format('Y-m-d'));
        $query->bindValue(':customerName', $orders->getCustomerName());
        $query->execute();

        $orders->setId($connection->lastInsertId());
    }

    /**
     * @param $id
     */
    public function delete(int $id)
    {
        $connection = Database::getConnection();

        $query = $connection->prepare("DELETE FROM orders WHERE id=:id");
        $query->bindValue(":id", $id);
        $query->execute();
    }



    /**
     * @param Orders $orders
     */
    public function update(Orders $orders)
    {

        $connection = Database::getConnection();
        $query = $connection->prepare("UPDATE orders SET createdAt=:createdAt,customerName=:customerName WHERE id=:id");
        $query->bindValue(':createdAt', $orders->getCreatedAt()->format('Y-m-d'));
        $query->bindValue(':customerName', $orders->getCustomerName());
        $query->bindValue(":id", $orders->getId());

        $query->execute();
    }
}
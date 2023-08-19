<?php

namespace App\Repository;
use PDO;

class Database
{

    public static function getConnection()
    {
        return new PDO("mysql:host=localhost;dbname=projet_parfum", "root", "1234");

    }
}
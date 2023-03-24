<?php


abstract class Database
{
    private static $pdo;

    public static function getInstance(): PDO
    {
        if (empty(self::$pdo)) {
            $host = "localhost";
            $name = "pintviewv1";
            $user = "root";
            $password = "";

            self::$pdo = new PDO(
                "mysql:host=$host;dbname=$name;charset=utf8",
                $user,
                $password,
                [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                ]
            );
        }

        return self::$pdo;
    }
}

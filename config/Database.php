<?php 

abstract class Database 
{
    private static $pdo;

    private static function setConnection()
    {
        self::$pdo = new PDO("mysql:host=localhost;dbname=uss;charset-UTF8","root", "");
        self::$pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_WARNING);
    }

    protected function getConnection()
    {
        if (self::$pdo === null){
            self::setConnection();
        }
        return self::$pdo;
    }
}
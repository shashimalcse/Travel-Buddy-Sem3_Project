<?php

namespace Core;

use PDO;
use App\Config;


 class Model
{


    // protected static function getDB()
    // {
    //     static $db = null;

    //     if ($db === null) {
    //         $dsn = 'mysql:host=' . Config::DB_HOST . ';dbname=' . Config::DB_NAME . ';charset=utf8';
    //         $db = new PDO($dsn, Config::DB_USER, Config::DB_PASSWORD);

    //         // Throw an Exception when an error occurs
    //         $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //     }

    //     return $db;
    // }
    protected static $db;


    private function __construct() {
        try {
            $dsn = 'mysql:host=' . Config::DB_HOST . ';dbname=' . Config::DB_NAME . ';charset=utf8';
            self::$db = new PDO($dsn, Config::DB_USER, Config::DB_PASSWORD);
            self::$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "MySql Connection Error: " . $e->getMessage();
        }
    }

    public static function getDB() {
        if (!self::$db) {
            new Model();
        }

        return self::$db;
    }

}

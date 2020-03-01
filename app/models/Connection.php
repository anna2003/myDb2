<?php
namespace App\models;

use App\models\Config;
use PDO;
use PDOException;


//class Connection
//{
//    public static function make($config){
//        try {
//            return new \PDO(
//                "mysql:host={$config['host']};dbname={$config['db']}",
//                $config['login'],
//                $config['password'],
//                $config['opt']
//            );
//        }
//        catch(PDOException $e){
//            die($e->getMessage());
//        }
//    }
//}

//class Connection
//{
//
//    private const CONN = [
//        "host" => "localhost",
//        "db" => "practic_posts",
//        "login" => "root",
//        "password" => "",
//        "opt" => [
//            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
//            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
//            PDO::ATTR_EMULATE_PREPARES => false
//        ]];
//
//    public static function make(){
//        try {
//            return new \PDO(
//                "mysql:host=".self::CONN['host'].";dbname=".self::CONN['db'],
//                self::CONN['login'],
//                self::CONN['password'],
//                self::CONN['opt']
//            );
//        }
//        catch(PDOException $e){
//            die($e->getMessage());
//        }
//    }
//}

class Connection
{
    public static function make(){
        try {
            return new PDO(
                "mysql:host=".Config::CONN['host'].";dbname=".Config::CONN['db'],
                Config::CONN['login'],
                Config::CONN['password'],
                Config::CONN['opt']
            );
        }
        catch(PDOException $e){
            die($e->getMessage());
        }
    }
}
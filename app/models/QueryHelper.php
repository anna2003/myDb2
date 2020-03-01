<?php

namespace App\models;

use PDO;
use App\models\Connection;

class QueryHelper
{
    public $pdo;
    public function __construct()
    {
        $this->pdo = Connection::make();
    }
//    public function __construct($config)
//    {
//        $this->pdo = Connection::make($config);
//    }

    public function getAll($table)
    {
        $stmt = $this->pdo->prepare("select * from $table");
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getOne($table, $id)
    {
        $stmt = $this->pdo->prepare("select * from $table where id = :id limit 1");
        $stmt->execute();
        return $stmt->fetch();
    }

    public function store($table, $data)
    {
        $keys = array_keys($data);
        $fields = implode(', ', $keys);
        $valueFields = ":" . implode(', :', $keys);
        $stmt = $this->pdo->prepare("insert into $table ($fields) values ($valueFields)");
        $stmt->execute($data);
        return $this->pdo->lastInsertId();
    }
    public function update($table, $data, $id)
    {
        $keys = array_keys($data);
        $params = array_map($data, function($key) {
            return $key . " = :" . $key;
        });

        $fields = implode(", ", $params);

        $stmt = $this->pdo->prepare("update $table set $fields where id = :id");
        $data["id"] = $id;
        $stmt->execute($data);
    }
    public function delete($table, $id)
    {
        $stmt = $this->pdo->prepare("delete from $table where id = :id");
        $stmt->execute();
    }
}
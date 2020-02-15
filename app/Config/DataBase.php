<?php

namespace App\Config;

class DataBase {

    private $conn;
    private static $db;

    public function __construct(){
        $this->connect();
    }

    private function connect(){
        try{
            $this->conn = new \PDO("mysql:host=".DB_SERVER.";dbname=".DB_DATABASE.";charset=utf8", DB_USERNAME, DB_PASSWORD);
            $this->conn->setAttribute(\PDO::ATTR_DEFAULT_FETCH_MODE, \PDO::FETCH_OBJ);
            $this->conn->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        }
        catch(PDOException $e){
            echo $e->getMessage();
        }
    }

    public static function instance(){
        if(self::$db === null){
            self::$db = new DataBase();
        }
        return self::$db;
    }

    public function executeQuery(string $query, Array $params = NULL){
        if($params != null){
            $stmt = $this->conn->prepare($query);
            $stmt->execute($params);
            return $stmt->fetchAll();
        }
        else{
            return $this->conn->query($query)->fetchAll();
        }
    }

    public function executeOneRow(string $query, Array $params = NULL){
        if($params != null)
        {
            $prepare = $this->conn->prepare($query);
            $prepare->execute($params);
            return $prepare->fetch();
        }
        else
        {
            return $this->conn->query($query)->fetch();
        }
    }

    public function executeQueryNonGet(string $query, Array $params){
        $prepare = $this->conn->prepare($query);
        try
        {
            $prepare->execute($params);
            return $prepare->rowCount();
        }
        catch(\PDOException $e)
        {
            //echo $e->getMessage();
        }
    }

    public function getLastInsertId(){
        return $this->conn->lastInsertId();
    }
}
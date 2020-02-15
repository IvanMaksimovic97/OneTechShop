<?php

namespace App\Models;
use App\Config\DataBase;

class Category extends BaseElement {

    public function getAll(){
        return $this->db->executeQuery("SELECT * FROM category");
    }

    public function getOne($id){
        return $this->db->executeOneRow("SELECT * FROM category WHERE id = ?", [$id]);
    }

    public function insert($request)
    {
        $name = $request['name'];
        $query = $this->db->executeQueryNonGet("INSERT INTO `category` (`id`, `name`) VALUES (NULL, ?)", [$name]);
        
    }
}
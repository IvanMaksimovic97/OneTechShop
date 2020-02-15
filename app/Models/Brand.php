<?php

namespace App\Models;
use App\Config\DataBase;

class Brand extends BaseElement {

    public function getAll(){
        return $this->db->executeQuery("SELECT * FROM brand ORDER BY name");
    }

    public function getOne($id){
        return $this->db->executeOneRow("SELECT * FROM brand WHERE id = ?", [$id]);
    }

    public function insert($request)
    {
        $name = $request['name'];
        $query = $this->db->executeQueryNonGet("INSERT INTO `brand` (`id`, `name`) VALUES (NULL, ?)", [$name]);
        
    }

    
}
<?php

namespace App\Models;
use App\Config\DataBase;

class Color extends BaseElement {

    public function getAll(){
        return $this->db->executeQuery("SELECT * FROM color");
    }

    public function getOne($id){
        return $this->db->executeOneRow("SELECT * FROM color WHERE id = ?", [$id]);
    }
}
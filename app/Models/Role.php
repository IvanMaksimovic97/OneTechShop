<?php

namespace App\Models;
use App\Config\DataBase;

class Role extends BaseElement {

    public function getAll(){
        return $this->db->executeQuery("SELECT * FROM role");
    }

    public function getOne($id){
        return $this->db->executeOneRow("SELECT * FROM role WHERE id = ?", [$id]);
    }
}
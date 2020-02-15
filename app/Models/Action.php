<?php

namespace App\Models;
use App\Config\DataBase;

class Action extends BaseElement {

    public function getAll(){
        return $this->db->executeQuery("SELECT a.*, u.first_name, u.last_name FROM actions a INNER JOIN user u ON a.user_id = u.id");
    }

    // public function getOne($id){
    //     return $this->db->executeOneRow("SELECT * FROM color WHERE id = ?", [$id]);
    // }
}
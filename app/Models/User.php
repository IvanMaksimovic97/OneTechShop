<?php

namespace App\Models;
use App\Config\DataBase;
//use App\Models\Role;

class User extends BaseElement {

    public function getAllUsersWithRoles(){
        return $this->db->executeQuery("SELECT u.id, u.first_name, u.last_name, u.email, u.created_at, u.active, r.name AS role_name FROM user u 
        INNER JOIN role r ON u.role_id = r.id");
    }

    public function getOne($id){
        return $this->db->executeOneRow("SELECT id, first_name, last_name, email, active, role_id FROM user WHERE id = ?", [$id]);
    }

    public function getUserWithEmailandPassword(string $email, string $password){
        return $this->db->executeOneRow("SELECT u.id, u.first_name, u.last_name, u.email, r.name AS role_name FROM `user` u INNER JOIN `role` r ON u.role_id = r.id WHERE u.email = ? AND u.password = SHA1(?) AND u.active = 1", [$email, $password]);
    }

    public function insertUser($params){
            
        $query = "INSERT INTO `user` (`id`, `first_name`, `last_name`, `email`, `password`, `created_at`, `active`, `auth_key`, `role_id`) 
        VALUES (NULL, ?, ?, ?, SHA1(?), CURRENT_TIMESTAMP, ?, ?, ?)";

        $success = $this->db->executeQueryNonGet($query, $params);
        
        if($success){
            return true;
        }
        else
        {
            return false;
        }
    }

    public function editUser($params){
        
        $query = "UPDATE `user` SET first_name = ?, last_name = ?, email = ?, password = SHA1(?), active = ?, role_id = ? WHERE id = ?";

        $success = $this->db->executeQueryNonGet($query, $params);

        $query = "INSERT INTO `actions` (`id`, `user_id`, `table_name`, `action`, `notification`, `ip_address`) VALUES (NULL, ?, ?, ?, ?, ?)";
        $query = $this->db->executeQueryNonGet($query, [$_SESSION['user']->id, "user", "Edit", "Edited User: ", $_SERVER['REMOTE_ADDR']]);
        
        if($success)
        {
            return true;
        }
        else
        {
            return false;
        }
    }
}
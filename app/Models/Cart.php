<?php

namespace App\Models;
use App\Config\DataBase;

class Cart extends BaseElement {

    public function getUserCart($id){
        $query = "SELECT c.total_price, c.quantity, p.price, i.path_small, i.alt, p.name AS product_name, cl.code, b.name AS brand_name, cl.name AS color_name 
        FROM cart c
        INNER JOIN product p ON c.product_id = p.id
        INNER JOIN color cl ON c.color_id = cl.id
        INNER JOIN brand b ON p.brand_id = b.id
        INNER JOIN image i ON p.image_id = i.id WHERE c.user_id = ?";
        return $this->db->executeQuery($query, [$id]);
    }

    public function getOne($id){
        return $this->db->executeOneRow("SELECT * FROM cart WHERE id = ?", [$id]);
    }

    public function addToCart($params1, $params2){

        $query = "INSERT INTO `cart` (`id`, `user_id`, `product_id`, `color_id`, `quantity`, `total_price`) VALUES (NULL, ?, ?, ?, ?, ?)";
        $success = $this->db->executeQueryNonGet($query, $params1);
        $success = $this->db->executeQueryNonGet("UPDATE `product` SET in_stock = ? WHERE id = ?", $params2);
        $success = $this->db->executeQueryNonGet("INSERT INTO `actions` (`id`, `user_id`, `table_name`, `action`, `notification`, `ip_address`) VALUES (NULL, ?, ?, ?, ?, ?)", [$_SESSION['user']->id, "cart", "Insert", "Product added to cart!", $_SERVER['REMOTE_ADDR']]);
    }
}
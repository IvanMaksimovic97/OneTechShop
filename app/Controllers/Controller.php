<?php

namespace App\Controllers;
use App\Config\DataBase;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Cart;

class Controller extends BaseController {

    protected function view(string $fileName, Array $data = []){
        // [ "proizvodi", "title"]
        $categories = new Category(DataBase::instance());
        $brands = new Brand(DataBase::instance());
        
        $categories = $categories->getAll();
        $brands = $brands->getAll();

        if(isset($_SESSION['user'])){
            $cart = new Cart(DataBase::instance());
            $cart = $cart->getUserCart($_SESSION['user']->id);
        }

        $base_url = $_SERVER['PHP_SELF'];
        $base_url = str_replace("/index.php", "", $base_url);
        
        extract($data); // OD ASOCIJATIVNOG NIZA - PRAVI PROMENJIVE
        
        $title = ucfirst($fileName);
        include "app/views/fixed/head.php";
        include "app/views/fixed/header.php";
        include "app/views/$fileName.php";
        include "app/views/fixed/footer.php";
    }
}
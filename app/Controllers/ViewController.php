<?php

namespace App\Controllers;
use App\Config\DataBase;
use App\Models\Color;
use App\Models\Product;
use App\Models\User;
use App\Models\Role;
use App\Models\Cart;
use App\Models\Action;

class ViewController extends Controller {

    public function home(){
        $colors = new Color(DataBase::instance());
        $colors = $colors->getAll();

        $products = new Product(DataBase::instance());
        $products = $products->getProductsWithFilters(null, null, null, null, null);

        $this->view("home", ["colors" => $colors, "products" => $products]);
    }

    public function product($id){
        $pruduct = new Product(DataBase::instance());
        $pruduct = $pruduct->getOne($id);

        $this->view("product", ["proizvod" => $pruduct]);
    }

    public function cart(){
        if(!$_SESSION['user']){
            $this->redirect();
        }
        else{
            $cart = new Cart(DataBase::instance());
            $cart = $cart->getUserCart($_SESSION['user']->id);
            $this->view("cart", ["cart" => $cart]);
        }
    }

    public function contact(){
        $this->view("contact");
    }

    public function author(){
        $this->view("author");
    }

    public function register(){
        if($this->auth()){
            $this->redirect();
        }
        else{
            $this->view("register");
        }
    }

    public function login(){
        if($this->auth()){
            $this->redirect();
        }
        else{
            $this->view("login");
        }
    }

    public function adminpanel(){
        if(!$this->is_admin()){
            $this->redirect();
        }
        else{
            $users = new User(DataBase::instance());
            $users = $users->getAllUsersWithRoles();

            $products = new Product(DataBase::instance());
            $products = $products->getProductsAdmin();

            $colors = new Color(DataBase::instance());
            $colors = $colors->getAll();

            $roles = new Role(DataBase::instance());
            $roles = $roles->getAll();

            $actions = new Action(DataBase::instance());
            $actions = $actions->getAll();

            $this->view("adminpanel", [
                "users" => $users, 
                "products" => $products, 
                "colors" => $colors, 
                "roles" => $roles,
                "actions" => $actions
            ]);
        }
    }
}
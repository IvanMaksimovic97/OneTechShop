<?php
session_start();
require_once "app/config/autoload.php";
require_once "app/config/db.php";

use App\Controllers\ColorController;
use App\Controllers\UserController;
use App\Controllers\LoginController;
use App\Controllers\BrandController;
use App\Controllers\CategoryController;
use App\Controllers\ProductController;
use App\Controllers\CartController;
use App\Controllers\ViewController;

$url = $_SERVER['REQUEST_URI'];
$url = str_replace("/php2sajt1", "", $url);
$url = str_replace("/index.php", "/", $url);
//var_dump($url);

$ss = explode("/", $url);
$route_id = 0;

if(count($ss) >= 3){
    $route_id = intval($ss[count($ss)-1]);
    if($route_id){
        $pozicija_kose_crte = strrpos($url, '/', 1);
        $url = substr($url, 0, $pozicija_kose_crte);
    }
}

switch($url){
    case "/colors" : 
        $boje = new ColorController();
        $boje->getAll();
    break;
    case "/register" :
        $user = new UserController();
        $user->register($_POST);
    break;
    case "/users" :
        $users = new UserController();
        $users->getAll();
    break;
    case "/user" :
        $users = new UserController();
        $users->getOne($route_id);
    break;
    case "/edituser" :
        $users = new UserController();
        $users->editUser($_POST);
    break;
    case "/login" :
        $login = new LoginController();
        $login->login($_POST);
    break;
    case "/logout" :
        $logout = new LoginController();
        $logout->logout();
    break;
    case "/brands" :
        $brands = new BrandController();
        $brands->getAll();
    break;
    case "/products" :
        $products = new ProductController();
        $products->getAll($_POST);
    break;
    case "/insertproduct" :
        $products = new ProductController();
        $products->insertProduct($_POST, $_FILES);
    break;
    case "/editproduct" :
        $products = new ProductController();
        $products->editProduct($_POST, $_FILES);
    break;
    case "/deleteproduct" :
        $products = new ProductController();
        $products->deleteProduct($_POST);
    break;
    case "/proizvod" :
        $product = new ProductController();
        $product->getOne($route_id);
    break;
    case "/categories" :
        $categories = new CategoryController();
        $categories->getAll();
    break;
    case "/addtocart" :
        $cart = new CartController();
        $cart->addToCart($_POST);
    break;
    case "/insertcategory" :
        $cart = new CategoryController();
        $cart->insert($_POST);
    break;
    case "/insertbrand" : 
        $cart = new BrandController();
        $cart->insert($_POST);
    break;
    case "/product" :
        $view = new ViewController(); 
        $view->product($route_id); 
    break;
    case "/cart" : 
        $view = new ViewController();
        $view->cart(); 
    break;
    case "/contact" : 
        $view = new ViewController();
        $view->contact(); 
    break;
    case "/author" : 
        $view = new ViewController();
        $view->author(); 
    break;
    case "/pageregister" : 
        $view = new ViewController();
        $view->register();
    break;
    case "/pagelogin" : 
        $view = new ViewController();
        $view->login();
    break;
    case "/adminpanel" : 
        $view = new ViewController();
        $view->adminpanel();
    break;
    default : 
        $view = new ViewController();
        $view->home(); 
    break;
}
<?php
namespace App\Controllers;
use App\Config\DataBase;
use App\Models\Cart;
use App\Models\Product;
use App\Models\Color;

class CartController extends BaseController {

    private $model;

    public function __construct(){
        $this->model = new Cart(DataBase::instance());
    }

    public function addToCart($request){
        
        if(!$this->auth()){
            $this->redirect();
        }
        else
        {   
            $product_id = $request['product_id'];
            $color_id = $request['color_id'];
            $quantity = $request['quantity'];

            if(!intval($product_id) || !intval($color_id) || !intval($quantity)){
                \http_response_code(400);
                return;
            }

            $product = new Product(DataBase::instance());
            $product = $product->getOne($product_id);

            $color = new Color(DataBase::instance());
            $color = $color->getOne($color_id);

            if(!is_object($product) || !is_object($color)){
                \http_response_code(404);
                return;
            }

            $product_color_ids = [];
            foreach($product->colors as $productColor){
                $product_color_ids[] = $productColor->id;
            }

            if(!\in_array($color_id, $product_color_ids)){
                \http_response_code(404);
                return;
            }

            if($quantity > $product->in_stock){
                \http_response_code(409);
                return;
            }

            $total_price = $product->price * $quantity;
            $params1 = [$_SESSION['user']->id, $product->id, $color->id, $quantity, $total_price];
            $new_in_stock = $product->in_stock - $quantity;
            $params2 = [$new_in_stock, $product->id];

            $bool = $this->model->addToCart($params1, $params2);
            \http_response_code(201);
        }
    }

    public function getUserCart($request){
        if(!$this->auth()){
            $this->redirect();
        }
        else
        {
            $bool = $this->model->addToCart($request);
            \http_response_code(200);
        }
    }
}
<?php
namespace App\Controllers;
use App\Config\DataBase;
use App\Models\Product;

class ProductController extends BaseController {
    private $model;

    public function __construct(){
        $this->model = new Product(DataBase::instance());
    }

    # /products
    public function getAll($request){
        if(count($request)){
            $brand_ids = isset($request['brand_ids']) ? $request['brand_ids'] : null;
            $cat_ids = isset($request['cat_ids']) ? $request['cat_ids'] : null;
            $price_from = isset($request['price_from']) ? $request['price_from'] : null;
            $price_to = isset($request['price_to']) ? $request['price_to'] : null;
            $sort_by = isset($request['sort_by']) ? $request['sort_by'] : null;

            if($brand_ids != null){
                foreach($brand_ids as $id){
                    if(!intval($id)){
                        $brand_ids = null;
                    }
                }
            }
            if($cat_ids != null){
                foreach($cat_ids as $id){
                    if(!intval($id)){
                        $cat_ids = null;
                    }
                }
            }
            if($price_from != null){
                if(!intval($price_from)){
                    $price_from = null;
                }
            }
            if($price_to != null){
                if(!intval($price_to)){
                    $price_to = null;
                }
            }
            $items = $this->model->getProductsWithFilters($cat_ids, $brand_ids, $price_from, $price_to, $sort_by);
            $this->json_output($items);

        }else{
            $items = $this->model->getProductsWithFilters(null, null, null, null, null);
            $this->json_output($items);
        }
    }

    # /proizvod
    public function getOne($id){
        $items = $this->model->getOne($id);
        $this->json_output($items);
    }

    # /insertproduct
    public function insertProduct($request, $image){
        if(!$this->is_admin()){
            $this->redirect();
        }else{
            $this->model->insertProduct($request, $image);
            $this->redirect("adminpanel");
        }
    }

    # /editproduct
    public function editProduct($request, $image){
        if(!$this->is_admin()){
            $this->redirect();
        }else{
            $this->model->editProduct($request, $image);
            $this->redirect("adminpanel");
        }
        
    }

    # /deleteproduct
    public function deleteProduct($request){
        if(!$this->is_admin()){
            $this->redirect();
        }else{
            $code = $this->model->deleteProduct($request);
            \http_response_code($code);
        }
    }
}
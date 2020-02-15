<?php
namespace App\Controllers;
use App\Config\DataBase;
use App\Models\Category;

class CategoryController extends BaseController {

    private $model;

    public function __construct(){
        $this->model = new Category(DataBase::instance());
    }

    public function getAll(){
        $items = $this->model->getAll();
        $this->json_output($items);
    }

    public function insert($req)
    {
        if(!$this->is_admin()){
            $this->redirect();
        }else{
            $this->model->insert($req);
            \http_response_code(201);
        }
    }
}
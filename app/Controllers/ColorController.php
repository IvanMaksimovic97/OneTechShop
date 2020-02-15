<?php
namespace App\Controllers;
use App\Config\DataBase;
use App\Models\Color;

class ColorController extends BaseController{

    private $model;

    public function __construct(){
        $this->model = new Color(DataBase::instance());
    }

    public function getAll(){
        $colors = $this->model->getAll();
        $this->json_output($colors);
    }
}
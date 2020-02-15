<?php
namespace App\Controllers;

class BaseController {

    protected function redirect($route = "home"){
        $base_url = $_SERVER['PHP_SELF'];
        $base_url = str_replace("/index.php", "", $base_url);
        if($route == "home"){
            \header("Location: ".$base_url);
        }
        else{
            \header("Location: ".$base_url."/".$route);
        }
    }

    protected function json_output($obj){
        header("Content-Type: application/json");
        echo json_encode($obj);
    }

    protected function auth(){
        if(isset($_SESSION['user'])){
            return true;
        }else{
            return false;
        }
    }

    protected function is_admin(){
        if($this->auth()){
            if($_SESSION['user']->role_name == "Admin"){
                return true;
            }
            else{
                return false;
            }
        }else{
            return false;
        }
    }
}
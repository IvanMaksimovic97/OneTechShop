<?php

namespace App\Controllers;
use App\Config\DataBase;
use App\Models\User;
use App\Models\Role;

class UserController extends BaseController {

    private $model;

    public function __construct(){
        $this->model = new User(DataBase::instance());
    }

    public function getAll(){
        $users = $this->model->getAllUsersWithRoles();
        $this->json_output($users);
    }

    public function getOne($id){
        $user = $this->model->getOne($id);
        $this->json_output($user);
    }

    public function register($request){

        $ok = true;

        $first_name = isset($request["first_name"]) ? $request["first_name"] : null;
        $last_name = isset($request["last_name"]) ? $request["last_name"] : null;
        $email = isset($request["email"]) ? $request["email"] : null;
        $password = isset($request["password"]) ? $request["password"] : null;

        if($first_name == null || $last_name == null || $email == null || $password == null){
            $ok = false;
        }

        if($this->is_admin()){
            $active = isset($request["active"]) ? $request["active"] : null;
            $role_id = isset($request["role_id"]) ? $request["role_id"] : null;

            if($active == null || $role_id == null){
                $ok = false;
            }
        }else{
            $active = 1;
            $role_id = 2;
        }

        $regName = "/^[A-ZŽĆČĐŠ][a-zžćčđš]{2,}$/";
        $regPass = "/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/";
        
        if(!\preg_match($regName, $first_name)){
            $ok = false;
            echo "ime nevalja";
        }

        if(!\preg_match($regName, $last_name)){
            $ok = false;
            echo "prezime ne valja";
        }

        if(!\preg_match($regPass, $password)){
            $ok = false;
            echo "password ne valja";
        }

        if(!\filter_var($email, FILTER_VALIDATE_EMAIL)){
            $ok = false;
            echo "email ne valja";
        }

        if($active < 0 || $active > 1){
            $ok = false;
            echo "aktivan ne valja";
        }
        
        $roles = new Role(DataBase::instance());
        if(!$roles->getOne($role_id)){
            //var_dump($roles->getOne($role_id));
            $ok = false;
            echo "uloga ne valja";
        }

        if($ok){
            $authKey = \md5(\uniqid());
            $params = [$first_name, $last_name, $email, $password, $active, $authKey, $role_id];
            $is_executed = $this->model->insertUser($params);
            if($is_executed){
                \http_response_code(201);
            }
            else{
                \http_response_code(409);
            }
        }
        else{
            \http_response_code(422);
        }
    }

    public function editUser($request){

        if(!$this->is_admin()){
            $this->redirect();
            return;
        }

        $u_id = isset($request["u_id"]) ? $request["u_id"] : null;
        if(!intval($u_id)){
            \http_response_code(400);
            return;
        }
        
        $user = $this->model->getOne($u_id);

        if(!$user){
            \http_response_code(404);
            return;
        }
        
        $ok = true;
    
        $first_name = isset($request["first_name"]) ? $request["first_name"] : $user->first_name;
        $last_name = isset($request["last_name"]) ? $request["last_name"] : $user->last_name;
        $email = isset($request["email"]) ? $request["email"] : $user->email;
        $password = isset($request["password"]) ? $request["password"] : $user->password;
        $active = isset($request["active"]) ? $request["active"] : $user->active;
        $role_id = isset($request["role_id"]) ? $request["role_id"] : $user->role_id;

        $regName = "/^[A-ZŽĆČĐŠ][a-zžćčđš]{2,}$/";
        $regPass = "/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/";
        
        if(!\preg_match($regName, $first_name)){
            $ok = false;
            echo "ime nevalja";
        }

        if(!\preg_match($regName, $last_name)){
            $ok = false;
            echo "prezime ne valja";
        }

        if(!\preg_match($regPass, $password)){
            $ok = false;
            echo "password ne valja";
        }

        if(!\filter_var($email, FILTER_VALIDATE_EMAIL)){
            $ok = false;
            echo "email ne valja";
        }

        if($active < 0 || $active > 1){
            $ok = false;
            echo "aktivan ne valja";
        }
        
        $roles = new Role(DataBase::instance());
        if(!$roles->getOne($role_id)){
            //var_dump($roles->getOne($role_id));
            $ok = false;
            echo "uloga ne valja";
        }

        if($ok){
            $params = [$first_name, $last_name, $email, $password, $active, $role_id, $user->id];
            $is_executed = $this->model->editUser($params);
            if($is_executed){
                \http_response_code(204);
            }
            else{
                \http_response_code(500);
            }
            
        }else{
            \http_response_code(422);
        }
    }
}
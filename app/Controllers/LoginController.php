<?php

namespace App\Controllers;
use App\Config\DataBase;
use App\Models\User;

class LoginController extends BaseController {

    public function login($request){
        //var_dump($request);
        if(isset($request['login'])){
            $email = $request['email'];
            $password = $request['password'];
            unset($_SESSION['errors']);
            
            if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
                 //echo "Nije ok email!";
                $_SESSION['errors']= "Wrong email format!";
            }
            else {
                
                $korisnik = new User(DataBase::instance());
                //echo "aaasssbbb";
                $user = $korisnik->getUserWithEmailandPassword($email, $password);
                //var_dump($user);
                if($user){
                    $_SESSION['user'] = $user;
                    $this->redirect();
                } else {
                    //echo "greska";
                    $_SESSION['errors'] ="User not found, wrong email or password";
                    $this->redirect("pagelogin");
                }
            }
            
        } else {
            \http_response_code(400);
        }
    }

    public function logout(){
        unset($_SESSION['user']);
        $this->redirect();
    }
}
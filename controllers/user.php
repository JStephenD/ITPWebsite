<?php
namespace controllers;
use models\User as UserModel;

class User {
    public function signup($vars, $httpmethod){
        if ($httpmethod == 'POST') {
            if (isset($_POST['signup'])) {

            }

            header('Location: /user/login');
        }

        require_once $_SERVER['DOCUMENT_ROOT'] . '/views/user_signup.php';
    }
    
    public function login($vars, $httpmethod){

    }

    public function logout($vars, $httpmethod){

    }
}

?>
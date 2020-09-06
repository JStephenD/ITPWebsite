<?php
namespace controllers;
use classes\Utils;

class Others {
    public function home($vars, $httpmethod) {
        Utils::login_required();
        require_once $_SERVER['DOCUMENT_ROOT'] . '/views/home.php';
    }
}

?>
<?php
class Others extends Controller{
    function __construct($db) {
        $this->db = $db;
    }

    function home($vars, $httpmethod) {
        $this->login_required();
        
        require_once $_SERVER['DOCUMENT_ROOT'] . '/views/home.php';
    }
}

?>
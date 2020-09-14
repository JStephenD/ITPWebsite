<?php
class Others extends Controller{
    function __construct($db) {
        $this->db = $db;
        $this->utils = new Utils();
    }

    function home($vars, $httpmethod) {
        $this->utils->login_required();
        
        require_once $_SERVER['DOCUMENT_ROOT'] . '/views/home.php';
    }
}

?>
<?php
class Others extends Controller{
    function __construct($db) {
        $this->db = $db;
        parent::__construct();
    }

    function home($vars, $httpmethod) {
        // $this->utils->login_required();

        if ($httpmethod == 'GET' || isset($_POST['ajax'])) {
            require_once $_SERVER['DOCUMENT_ROOT'] . '/views/home.php';
        }
    }

    function redirect($vars, $httpmethod) {
    }
}

?>
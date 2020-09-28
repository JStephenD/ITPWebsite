<?php

class Mapping extends Controller
{
    function __construct($db)
    {
        $this->db = $db;
        parent::__construct();
    }

    function mapping($vars, $httpmethod) {
        $this->utils->login_required();

        if ($httpmethod == 'GET' || isset($_POST['ajax'])) {
            require_once $_SERVER['DOCUMENT_ROOT'] . '/views/mapping/mapping.php';
        }
    }

    function mapping_citymun($vars, $httpmethod) {
        $this->utils->login_required();
        $this->utils->permsRequired(
            (isset($_SESSION['user']['perms'])) ? $_SESSION['user']['perms'] : '0',
            ['mapping_citymun']
        );

        if ($httpmethod == 'GET' || isset($_POST['ajax'])) {
            require_once $_SERVER['DOCUMENT_ROOT'] . '/views/mapping/mapping_citymun.php';
        }
    }

    function mapping_barangay($vars, $httpmethod) {
        $this->utils->login_required();

        if ($httpmethod == 'GET' || isset($_POST['ajax'])) {
            require_once $_SERVER['DOCUMENT_ROOT'] . '/views/mapping/mapping_barangay.php';
        }
    }
}

?>
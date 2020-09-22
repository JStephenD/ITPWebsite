<?php

class Mapping extends Controller
{
    function __construct($db)
    {
        $this->db = $db;
        $this->utils = new Utils();
    }

    function mapping($vars, $httpmethod)
    {
        $this->utils->login_required();

        if ($httpmethod == 'GET' || isset($_POST['ajax'])) {
            require_once $_SERVER['DOCUMENT_ROOT'] . '/views/mapping/mapping.php';
        }
    }

    function mapping_citymun($vars, $httpmethod)
    {
        $this->utils->login_required();

        if ($httpmethod == 'GET' || isset($_POST['ajax'])) {
            require_once $_SERVER['DOCUMENT_ROOT'] . '/views/mapping/mapping_citymun.php';
        }
    }

    function mapping_barangay($vars, $httpmethod)
    {
        $this->utils->login_required();

        if ($httpmethod == 'GET' || isset($_POST['ajax'])) {
            require_once $_SERVER['DOCUMENT_ROOT'] . '/views/mapping/mapping_barangay.php';
        }
    }
}

?>
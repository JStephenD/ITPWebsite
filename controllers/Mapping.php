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
        } else if (isset($_POST['getLocation'])) {
            $ipadd = $this->utils->getPublicIp();
            $loc = $this->utils->getLocation($ipadd);

            header('Content-Type: application/json');
            echo json_encode($loc);
        }
    }
}

?>
<?php

class Mapping extends Controller {
    function __construct($db) {
        $this->db = $db;
        $this->utils = new Utils();
    }

    function mapping($vars, $httpmethod) {
        $this->utils->login_required();
        
        if ($httpmethod == 'POST') {

        } else {
            $ipadd = $this->utils->getPublicIp();
            $loc = $this->utils->getLocation($ipadd);

            require_once $_SERVER['DOCUMENT_ROOT'] . '/views/mapping/mapping.php';
        }
    }

}

?>
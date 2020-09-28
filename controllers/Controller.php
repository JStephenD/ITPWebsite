<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/classes/Utils.php';

class Controller {

    function __construct() {
        $this->utils = new Utils();
    }
}
?>
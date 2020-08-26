<?php

namespace controller;

require_once 'loader.php';
echo '<script>alert("hello world")</script>';

class covidtraceController {
    public function citymunicipality() {
        echo '<script>alert("hello funct")</script>';
        echo $mdl_header;
        echo $mdl_navbar;
        require_once 'views/citymunicipality.php';
        echo $mdl_sidebar;
        echo $mdl_sidebar_right;
        echo $mdl_footer;
    }
}
<?php

spl_autoload_register();
$header_class = new views\modules\header();
$mdl_header = $header_class->get();

$footer_class = new views\modules\footer();
$mdl_footer = $footer_class->get();

$navbar_class = new views\modules\navbar();
$mdl_navbar = $navbar_class->get();

$sidebar_class = new views\modules\sidebar();
$mdl_sidebar = $sidebar_class->get();

$sidebar_right_class = new \views\modules\sidebar_right();
$mdl_sidebar_right = $sidebar_right_class->get();

$render = new classes\render();

// $covidtraceContoller = new \controller\covidtraceController();
<?php

// use function PHPSTORM_META\type;

ob_start(); 

// AUTOLOAD
require 'loader.php';
require 'vendor/autoload.php';
//

$dispatcher = FastRoute\simpleDispatcher(function(FastRoute\RouteCollector $r) {
    // $r->addRoute('GET', '/', '', 'home.php');
    $r->addRoute(['GET', 'POST'], '/citymunicipality', ['CovidTrace', 'citymunicipality']);
    $r->addRoute(['GET', 'POST'], '/barangay', ['CovidTrace', 'barangay']);
});

// Fetch method and URI from somewhere
$httpMethod = $_SERVER['REQUEST_METHOD'];
$uri = $_SERVER['REQUEST_URI'];

// Strip query string (?foo=bar) and decode URI
if (false !== $pos = strpos($uri, '?')) {
    $uri = substr($uri, 0, $pos);
}
$uri = rawurldecode($uri);
// echo $uri.'<br>';

$routeInfo = $dispatcher->dispatch($httpMethod, $uri);
switch ($routeInfo[0]) {
    case FastRoute\Dispatcher::NOT_FOUND:
        require_once 'views/modules/header.php';
        require_once 'views/modules/navbar.php';
            
        require_once 'views/home.php';

        require_once 'views/modules/sidebar.php';
        require_once 'views/modules/sidebar_right.php';
        require_once 'views/modules/footer.php';
        break;
    case FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
        $allowedMethods = $routeInfo[1];
        // ... 405 Method Not Allowed
        break;
    case FastRoute\Dispatcher::FOUND:
        $classname = $routeInfo[1][0];
        $controller = '\\controllers\\'.$classname;

        $method = $routeInfo[1][1];
        $vars = $routeInfo[2];

        require_once $_SERVER['DOCUMENT_ROOT'] . '/views/modules/header.php';
        require_once $_SERVER['DOCUMENT_ROOT'] . '/views/modules/navbar.php';
        
        $class = new $controller();
        call_user_func_array([$class, $method], [$vars, $httpMethod]);

        require_once $_SERVER['DOCUMENT_ROOT'] . '/views/modules/sidebar.php';
        require_once $_SERVER['DOCUMENT_ROOT'] . '/views/modules/sidebar_right.php';
        require_once $_SERVER['DOCUMENT_ROOT'] . '/views/modules/footer.php';

        break;
}
ob_end_flush();
?>
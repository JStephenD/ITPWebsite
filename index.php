<?php

// echo __FILE__. '<br>';

require 'loader.php';

require 'vendor/autoload.php';

$dispatcher = FastRoute\simpleDispatcher(function(FastRoute\RouteCollector $r) {
    $r->addRoute('GET', '/', 'home.php');
    $r->addRoute('GET', '/citymunicipality', ['covidtraceController', 'citymunicipality']);
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
        echo 'not_found';
        // ... 404 Not Found
        break;
    case FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
        $allowedMethods = $routeInfo[1];
        // ... 405 Method Not Allowed
        break;
    case FastRoute\Dispatcher::FOUND:
        $controller = '\\controller\\'.$routeInfo[1][0];
        $method = $routeInfo[1][1];
        $vars = $routeInfo[2];

        echo $mdl_header;
        echo $mdl_navbar;
        
        $class = new $controller();
        call_user_func_array([$class, $method], [$vars]);

        echo $mdl_sidebar;
        echo $mdl_sidebar_right;
        echo $mdl_footer;
        break;
}

?>
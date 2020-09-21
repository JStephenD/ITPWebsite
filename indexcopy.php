<?php

ob_start();
session_start();

// AUTOLOAD
function loadClasses($class)
{
    var_dump($class);
    echo '<br><br>';
    $dirs = [
        $_SERVER['DOCUMENT_ROOT'] . '/controllers/',
        $_SERVER['DOCUMENT_ROOT'] . '/models/',
        $_SERVER['DOCUMENT_ROOT'] . '/classes/',
        $_SERVER['DOCUMENT_ROOT'] . '/ajaj/',
    ];

    foreach ($dirs as $dir) {
        if (file_exists($dir . $class . '.php')) {
            require_once $dir . $class . '.php';
        }
    }
}

spl_autoload_register('loadClasses');
var_dump($_SERVER);
$messages = new Messages();
$db = new Connection();

require 'classes/loader.php';
require 'vendor/autoload.php';

require 'vendor/vlucas/phpdotenv/src/Dotenv.php';
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();
//

$dispatcher = FastRoute\simpleDispatcher(function (FastRoute\RouteCollector $r) {
    $r->addRoute(['GET', 'POST'], '/citymunicipality/add', ['CovidTrace', 'citymunicipality_add']);
    $r->addRoute(['GET', 'POST'], '/citymunicipality/listing', ['CovidTrace', 'citymunicipality_listing']);
    $r->addRoute(['GET', 'POST'], '/citymunicipality/edit/{id:\d+}', ['CovidTrace', 'citymunicipality_edit']);
    $r->addRoute(['GET', 'POST'], '/citymunicipality/delete/{id:\d+}', ['CovidTrace', 'citymunicipality_delete']);

    $r->addRoute(['GET', 'POST'], '/barangay/add', ['CovidTrace', 'barangay_add']);
    $r->addRoute(['GET', 'POST'], '/barangay/listing', ['CovidTrace', 'barangay_listing']);
    $r->addRoute(['GET', 'POST'], '/barangay/edit/{id:\d+}', ['CovidTrace', 'barangay_edit']);
    $r->addRoute(['GET', 'POST'], '/barangay/delete/{id:\d+}', ['CovidTrace', 'barangay_delete']);

    $r->addRoute(['GET', 'POST'], '/user/signup', ['User', 'user_signup']);
    $r->addRoute(['GET', 'POST'], '/user/login', ['User', 'user_login']);
    $r->addRoute(['GET', 'POST'], '/user/logout', ['User', 'user_logout']);
    $r->addRoute(['GET', 'POST'], '/user/account', ['User', 'user_account']);

    $r->addRoute(['GET', 'POST'], '/mapping', ['Mapping', 'mapping']);

    $r->addRoute(['GET'], '/', ['Others', 'home']);
});

// Fetch method and URI from somewhere
$httpMethod = $_SERVER['REQUEST_METHOD'];
$uri = $_SERVER['REQUEST_URI'];

// Strip query string (?foo=bar) and decode URI
if (false !== $pos = strpos($uri, '?')) {
    $uri = substr($uri, 0, $pos);
}
$uri = rawurldecode($uri);

$routeInfo = $dispatcher->dispatch($httpMethod, $uri);
switch ($routeInfo[0]) {
    case FastRoute\Dispatcher::NOT_FOUND:
        require_once 'views/modules/header.php';
        require_once 'views/modules/navbar.php';
        $messages->show();

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
        $method = $routeInfo[1][1];

        $vars = $routeInfo[2];

        if ($httpMethod == 'GET') {
            require_once __DIR__ . '/views/modules/header.php';
            require_once __DIR__ . '/views/modules/navbar.php';
            $messages->show();
        }

        $class = new $classname($db->connect());
        call_user_func_array([$class, $method], [$vars, $httpMethod]);

        if ($httpMethod == 'GET') {
            require_once __DIR__ . '/views/modules/sidebar.php';
            require_once __DIR__ . '/views/modules/sidebar_right.php';
            require_once __DIR__ . '/views/modules/footer.php';
        }

        break;
}
ob_end_flush();

<?php

// echo '<pre>';
// print_r($_SERVER);
// echo '</pre>';

ob_start();
session_start();

// AUTOLOAD
function loadClasses($class)
{
    $dirs = [
        __DIR__ . '/controllers/',
        __DIR__ . '/models/',
        __DIR__ . '/classes/',
        __DIR__ . '/ajaj/',
    ];    

    foreach ($dirs as $dir) {
        if (file_exists($dir . $class . '.php')) {
            require_once $dir . $class . '.php';
        }
        if (file_exists($dir . strtolower($class) . '.php')) {
            require_once $dir . strtolower($class) . '.php';
        }
    }
}

spl_autoload_register('loadClasses');

$messages = new Messages();
$utils = new Utils();
$db = new Connection();

require_once 'classes/Loader.php';
require_once 'vendor/autoload.php';


if (file_exists($_SERVER['DOCUMENT_ROOT'] . '/.env')) {
    $dotenv = Dotenv\Dotenv::createImmutable($_SERVER['DOCUMENT_ROOT'], '/.env');
    $dotenv->load();
}
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
    $r->addRoute(['GET', 'POST'], '/mapping/citymunicipality', ['Mapping', 'mapping_citymun']);
    $r->addRoute(['GET', 'POST'], '/mapping/barangay', ['Mapping', 'mapping_barangay']);

    $r->addRoute(['GET', 'POST'], '/admin/accounts', ['Admin', 'admin_accounts']);
    $r->addRoute(['GET', 'POST'], '/admin/accounts/delete/{id:\d+}', ['Admin', 'admin_accounts_delete']);
    $r->addRoute(['GET', 'POST'], '/admin/test', ['Admin', 'test']);

    $r->addRoute(['GET', 'POST'], '/tracing/employee', ['Tracing', 'tracing_employee_log']);
    $r->addRoute(['POST'], '/tracing/employee/add', ['Tracing', 'tracing_employee_add']);
    $r->addRoute(['GET', 'POST'], '/tracing/customer', ['Tracing', 'tracing_customer_log']);

    $r->addRoute(['GET'], '/', ['Others', 'home']);
    $r->addRoute(['GET'], '/redirect', ['Others', 'redirect']);
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

        echo 'method not allowed';

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

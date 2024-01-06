<?php

require_once 'framework/Router.php';
require_once 'controllers/LoginController.php';
require_once 'controllers/LearnController.php';
require_once 'controllers/AdminController.php';
require_once 'controllers/ModulesController.php';
require_once 'controllers/LogoutController.php';

$router = new Router();

// routing
$router->addRoute('login', 'LoginController');
$router->addRoute('learn', 'LearnController');
$router->addRoute('admin', 'AdminController');
$router->addRoute('modules', 'ModulesController');
$router->addRoute('logout', 'LogoutController');

// pobranie aktualnej ścieżki z URL 
$url = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

// ustawienie domyślnej ścieżki na /learn
if ($url === '/' || $url === '') {
    $url = '/learn';
}

// przekazanei ścieżki do routera
$router->dispatch($url);
<?php

require_once 'framework/Router.php';
require_once 'controllers/LoginController.php';
require_once 'controllers/LearnController.php';
require_once 'controllers/AdminController.php';
require_once 'controllers/ModulesController.php';
require_once 'controllers/LogoutController.php';

$router = new Router();

$router->addRoute('login', 'LoginController');
$router->addRoute('learn', 'LearnController');
$router->addRoute('admin', 'AdminController');
$router->addRoute('modules', 'ModulesController');
$router->addRoute('logout', 'LogoutController');

// Pobranie aktualnej ścieżki z URL (możesz to robić w routerze)
$url = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

// Domyślna ścieżka do nauki, jeśli żadna inna nie pasuje
if ($url === '/' || $url === '') {
    $url = '/learn';
}

// Przekazanie ścieżki do routera w celu obsługi żądania
$router->dispatch($url);
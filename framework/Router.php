<?php

class Router {
    protected $routes = [];

    public function addRoute($route, $controller) {
        $this->routes[$route] = $controller;
    }

    public function dispatch($url) {
        $url = trim($url, '/');
        
        if (array_key_exists($url, $this->routes)) {
            $controller = $this->routes[$url];

            if (class_exists($controller)) {
                $controllerObj = new $controller();

                if (method_exists($controllerObj, 'run')) {
                    $controllerObj->run();
                } else {
                    echo "Błąd: Metoda 'run' nie istnieje w kontrolerze.";
                }
            } else {
                echo "Błąd: Kontroler nie istnieje.";
            }
        } else {
            echo "Błąd 404: Strona nie istnieje dla URL: $url";
        }
    }
}

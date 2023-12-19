<?php

require_once 'View.php'; 

class Controller {
    protected $view;

    public function __construct() {
        $this->view = new View();
    }
    
    public function run() {
        // To będzie nadpisywane przez konkretne kontrolery
        echo "Default Controller";
    }
}

<?php

require_once __DIR__ . '/../framework/Controller.php';

class AdminController extends Controller {
    public function run() {
        if (!isset($_SESSION['user'])) {
            // Jeśli nie jest zalogowany, przekieruj na /login
            header('Location: /login');
            exit();
        }

        if ($_SESSION['user'] !== "admin") {
            // Jeśli użytkownik to nie admin, przekieruj na /learn
            header('Location: /learn');
            exit();
        }

        $this->view->render('admin');
    }

    
}
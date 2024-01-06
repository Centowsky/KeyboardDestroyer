<?php
require_once __DIR__ . '/../framework/Controller.php';

class LearnController extends Controller {
    public function run() {
        // sprawdzenie czy sesja aktywna
        if (session_status() === PHP_SESSION_NONE) {
            // nie = rozpocznij sesje
            session_start();
        }

        // jesli nie zalogowany przekieruj do logowania
        if (!isset($_SESSION['user'])) {
            header('Location: /login');
            exit();
        }

        $this->view->username = $_SESSION['user'];

        $this->displayModules();
    }

    private function displayModules() {
        $this->view->render('learn');
    }
}
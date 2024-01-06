<?php
require_once __DIR__ . '/../framework/Controller.php';

class LearnController extends Controller {
    public function run() {
        // Sprawdź, czy sesja jest już aktywna
        if (session_status() === PHP_SESSION_NONE) {
            // Jeśli nie, rozpocznij sesję
            session_start();
        }

        // Warunek sprawdzenia sesji, jeśli nie jest zalogowany, przekieruj na /login
        if (!isset($_SESSION['user'])) {
            header('Location: /login');
            exit();
        }

        $this->view->username = $_SESSION['user'];

        // Reszta kodu kontrolera LearnController
        $this->displayModules();
    }

    private function displayModules() {
        $this->view->render('learn');
    }

    // Pozostała część kodu kontrolera...
}
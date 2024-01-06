<?php

require_once __DIR__ .  '/../framework/Controller.php';

class LogoutController extends Controller {
    public function run() {
        // Zakończ sesję
        session_start();
        session_unset();
        session_destroy();

        // Przekieruj na stronę logowania
        header('Location: /login');
        exit();
    }
}

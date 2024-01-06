<?php
session_start();
require_once __DIR__ . '/../framework/Controller.php';

class LoginController extends Controller {
    public function run() {
        // Warunek sprawdzenia sesji, jeśli zalogowany to przekierowanie na /learn
        if (isset($_SESSION['user'])) {
            header('Location: /learn');
            exit();
        }

        // Dane z formularza
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'] ?? '';
            $password = $_POST['password'] ?? '';

            // Sprawdzenie poprawności danych
            if ($this->authenticateUser($username, $password)) {
                // Utworzenie sesji i przekierowanie
                $_SESSION['user'] = $username;
                header('Location: /learn');
                exit();
            } else {
                // Komunikat o błędzie podczas logowania
                $this->view->error = 'Błędne dane logowania.';
            }
        }
        
        // Włącz buforowanie wyjścia
        ob_start();
        
        // Wyrenderuj widok
        $this->view->render('login');
        
        // Wyślij bufor i wyczyść go
        ob_end_flush();
    }

    private function authenticateUser($username, $password) {
        try {
            $db = new PDO('mysql:host=localhost;dbname=keyboard_destroyer', 'root', '');
    
            $query = 'SELECT * FROM users WHERE Username = :username';
            $stmt = $db->prepare($query);
            $stmt->bindParam(':username', $username);
    
            $stmt->execute();
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
    
            if ($user && $password === $user['Password']) {
                return true;
            } else {
                return false;
            }
        } catch (PDOException $e) {
            die('Błąd bazy danych: ' . $e->getMessage());
        }
    }
}

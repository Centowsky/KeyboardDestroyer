<?php

require_once __DIR__ . '/../framework/Controller.php';

class AdminController extends Controller {
    public function run() {
        if (!isset($_SESSION['user'])) {
            // Jeśli nie jest zalogowany, przekieruj na /login
            header('Location: /login');
            exit();
        }

        // Sprawdź, czy użytkownik to admin
        if ($_SESSION['user'] !== "admin") {
            // Jeśli użytkownik to nie admin, przekieruj na /learn
            header('Location: /learn');
            exit();
        }

        $this->view->render('admin');

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['module_name'], $_POST['difficulty_level'])) {
            $moduleName = $_POST['module_name'];
            $difficultyLevel = $_POST['difficulty_level'];

            // Kod do dodawania modułu do bazy danych
            // ...

            // Przykład:
            echo "Dodano moduł: $moduleName, Poziom Trudności: $difficultyLevel";
        }

        // Obsługa formularza dodawania lekcji
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['module_id'], $_POST['lesson_name'])) {
            $moduleId = $_POST['module_id'];
            $lessonName = $_POST['lesson_name'];

            // Kod do dodawania lekcji do bazy danych
            // ...

            // Przykład:
            echo "Dodano lekcję: $lessonName, do modułu o ID: $moduleId";
        }
    }

    
}
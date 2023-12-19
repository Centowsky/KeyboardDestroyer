<?php

require_once '../framework/Controller.php';

class LearnController extends Controller {
    public function run() {
        // Jeżeli nie ma danych POST, to wyświetl aktualne moduły z Local Storage
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Odczytaj dane przesłane przez AJAX
            $postData = file_get_contents("php://input");
            $moduleData = json_decode($postData, true);

            // Sprawdź, czy 'modules' istnieje w danych JSON
            if (isset($moduleData['modules'])) {
                // Odczytaj listę modułów
                $modules = $moduleData['modules'];

                // Przekazuje moduły do widoku
                $this->view->modules = $modules;

                // Wyświetl widok
                $this->view->render('learn');
            }
        } else {
            // Wyświetl aktualne moduły z Local Storage
            $this->displayModules();
        }
    }

    // Funkcja do wyświetlania modułów
    private function displayModules() {
        // Pobierz listę modułów z Local Storage
        $modules = $this->getModulesFromLocalStorage();

        // Przekazuje moduły do widoku
        $this->view->modules = $modules;

        // Wyświetl widok
        $this->view->render('learn');
    }

    // Funkcja do odczytywania modułów z Local Storage
    private function getModulesFromLocalStorage() {
        // Pobierz dane z Local Storage
        $modulesJSON = $_POST['modules'] ?? '[]';

        // Odczytaj listę modułów
        return json_decode($modulesJSON, true) ?: [];
    }
}

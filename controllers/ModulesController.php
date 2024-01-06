<?php

require_once __DIR__ . '/../framework/Controller.php';

class ModulesController extends Controller {
    public function run() {
        // Sprawdź, czy przesyłane są dane POST
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Odczytaj dane przesłane przez AJAX
            $postData = file_get_contents("php://input");
            $moduleData = json_decode($postData, true);

            // Sprawdź, czy 'moduleName' istnieje w danych JSON
            if (isset($moduleData['moduleName'])) {
                // Odczytaj nazwę modułu
                $moduleName = $moduleData['moduleName'];

                // Dodaj nowy moduł do Local Storage
                $this->addModuleToLocalStorage($moduleName);

                // Odpowiedź AJAX (opcjonalne)
                echo json_encode(['success' => true]);
            } else {
                // W przypadku braku 'moduleName', zwróć błąd
                echo json_encode(['success' => false, 'error' => 'Missing moduleName']);
            }
        } else {
            // Jeżeli nie ma danych POST, to wyświetl aktualne moduły z Local Storage
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
        $this->view->render('modules');
    }

    // Funkcja do odczytywania modułów z Local Storage
    private function getModulesFromLocalStorage() {
        // Pobierz listę modułów z Local Storage
        $modulesJSON = $_POST['modules'] ?? '[]';
        return json_decode($modulesJSON, true) ?: [];
    }

    // Funkcja do dodawania modułu do Local Storage
    private function addModuleToLocalStorage($moduleName) {
        // Pobierz aktualną listę modułów z Local Storage
        $modules = $this->getModulesFromLocalStorage();

        // Dodaj nowy moduł
        $modules[] = $moduleName;

        // Zapisz zaktualizowaną listę modułów do Local Storage
        $this->saveModulesToLocalStorage($modules);
    }

    // Funkcja do zapisywania modułów do Local Storage
    private function saveModulesToLocalStorage($modules) {
        // Zapisz listę modułów do Local Storage
        $modulesJSON = json_encode($modules);
        $_POST['modules'] = $modulesJSON;
    }
}

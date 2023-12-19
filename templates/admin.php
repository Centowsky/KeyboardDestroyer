<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel Administracyjny</title>
</head>
<body>
    <h2>Panel Administracyjny</h2>

    <!-- Formularz do tworzenia nowych modułów -->
    <form id="moduleForm">
        <label for="module_name">Nazwa modułu:</label>
        <input type="text" id="module_name" required>
        <button type="button" onclick="createModule()">Utwórz moduł</button>
        <p id="errorMessage" style="color: red;"></p> <!-- Dodany element do wyświetlania błędu -->
    </form>

    <h2>Lista Modułów</h2>
    <ul id="moduleList"></ul>

    <script>
        // Funkcja do obsługi przycisku "Utwórz moduł"
        function createModule() {
            var moduleName = document.getElementById('module_name').value;

            // Sprawdź, czy nazwa modułu została wprowadzona
            if (moduleName.trim() === "") {
                document.getElementById('errorMessage').textContent = "Wprowadź nazwę modułu.";
                return;
            }

            // Wyczyść ewentualny wcześniejszy komunikat o błędzie
            document.getElementById('errorMessage').textContent = "";

            // Pobierz aktualną listę modułów z Local Storage
            var modules = JSON.parse(localStorage.getItem('modules')) || [];

            // Dodaj nowy moduł
            modules.push(moduleName);

            // Zapisz zaktualizowaną listę modułów do Local Storage
            localStorage.setItem('modules', JSON.stringify(modules));

            // Wyświetl zaktualizowaną listę modułów na stronie
            displayModules();

            // Wyślij dane za pomocą AJAX
            sendModuleData(moduleName);
        }

        // Funkcja do wyświetlania listy modułów
        function displayModules() {
            var moduleList = document.getElementById('moduleList');
            moduleList.innerHTML = '';

            // Pobierz listę modułów z Local Storage
            var modules = JSON.parse(localStorage.getItem('modules')) || [];

            // Wyświetl każdy moduł na stronie
            modules.forEach(function (module) {
                var listItem = document.createElement('li');
                listItem.textContent = module;
                moduleList.appendChild(listItem);
            });
        }

        // Funkcja do przesyłania danych za pomocą AJAX
        function sendModuleData(moduleName) {
            var xhr = new XMLHttpRequest();
            xhr.open('POST', '/modules', true);
            xhr.setRequestHeader('Content-Type', 'application/json');

            // Przygotuj dane do przesłania
            var data = {
                moduleName: moduleName
            };

            // Wyślij dane w formie JSON
            xhr.send(JSON.stringify(data));
        }

        // Wyświetl istniejące moduły przy ładowaniu strony
        displayModules();
    </script>
</body>
</html>
